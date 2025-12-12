<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use App\Models\Alert; // <-- asegurate de tener este modelo
use App\Http\Requests\StoreTransactionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Events\TransactionCreated;
use App\Events\TransactionUpdated;
use App\Events\TransactionDeleted;
use App\Notifications\OverSpendNotification; // <-- notificación opcional

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Auth::user()->transactions()->latest('transaction_date')->paginate(15);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('transactions.create', compact('categories'));
    }

    public function store(StoreTransactionRequest $request)
    {
        $transaction = Auth::user()->transactions()->create($request->validated());
        event(new TransactionCreated($transaction));

        // --- ALERT LOGIC (non-intrusive) ---
        $this->checkAndHandleOverSpend($transaction->user_id, $transaction);
        // -------------------------------------

        return redirect()->route('transactions.index')->with('success','Transacción registrada exitosamente.');
    }

    public function show(Transaction $transaction)
    {
        //
    }

    public function edit(Transaction $transaction)
    {
        $this->authorize('update',$transaction);
        $categories = Category::all();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function update(StoreTransactionRequest $request, Transaction $transaction)
    {
        $this->authorize('update' ,$transaction);
        $transaction->update($request->validated());
        event(new TransactionUpdated($transaction));

        // --- ALERT LOGIC (non-intrusive) ---
        $this->checkAndHandleOverSpend($transaction->user_id, $transaction);
        // -------------------------------------

        return redirect()->route('transactions.index')->with('success','Transaccion actualizada exitosamente');
    }

    public function destroy(Transaction $transaction)
    {
        $this->authorize('delete' ,$transaction);

        // guarda user_id antes de borrar
        $userId = $transaction->user_id;

        $transactionData = $transaction->toArray();
        $user = $transaction->user;

        $transaction->delete();
        event(new TransactionDeleted(new Transaction($transactionData),$user));

        // --- ALERT LOGIC (non-intrusive) ---
        // pasamos null porque la transacción ya fue eliminada
        $this->checkAndHandleOverSpend($userId, null);
        // -------------------------------------

        return redirect()->route('transactions.index')->with('success','Transaccion eliminada exitosamente');
    }

    /**
     * Método privado que calcula totales y crea/resuelve alertas.
     * - Usa 'transaction_type' en la tabla transactions.
     * - Usa 'type' en la tabla alerts (valor 'over_spend').
     *
     * @param int $userId
     * @param Transaction|null $transaction
     * @return void
     */
    private function checkAndHandleOverSpend(int $userId, ?Transaction $transaction = null): void
    {
        // calcular totales usando la columna real transaction_type
        $totalIncome = Transaction::where('user_id', $userId)
                                  ->where('transaction_type', 'income')
                                  ->sum('amount');

        $totalExpense = Transaction::where('user_id', $userId)
                                   ->where('transaction_type', 'expense')
                                   ->sum('amount');

        // si gasto > ingreso -> crear alerta si no existe una no-leída igual
        if ($totalExpense > $totalIncome) {
            $existing = Alert::where('user_id', $userId)
                             ->where('type', 'over_spend') // ALERTS usan 'type'
                             ->where('read', false)
                             ->first();

            if (! $existing) {
                $diff = $totalExpense - $totalIncome;

                $alert = Alert::create([
                    'user_id' => $userId,
                    'type' => 'over_spend',
                    'title' => 'Gastos superan ingresos',
                    'message' => "Tus gastos (".number_format($totalExpense,2).") superan tus ingresos (".number_format($totalIncome,2).") por ".number_format($diff,2),
                    'meta' => [
                        'total_income' => $totalIncome,
                        'total_expense' => $totalExpense,
                        'transaction_id' => $transaction ? $transaction->id : null,
                    ],
                    'read' => false,
                ]);

                // notificamos por canal database (y mail si OverSpendNotification lo define)
                try {
                    $user = $alert->user;
                    if ($user) {
                        $user->notify(new OverSpendNotification($alert));
                    }
                } catch (\Throwable $e) {
                    // no interrumpir el flujo; loguear para debug
                    Log::warning("No se pudo notificar al usuario (OverSpendNotification): ".$e->getMessage());
                }
            }
        } else {
            // si ya no hay exceso, marcar alertas no-leídas 'over_spend' como leídas
            Alert::where('user_id', $userId)
                 ->where('type', 'over_spend')
                 ->where('read', false)
                 ->update(['read' => true]);
        }
    }
}
