<!DOCTYPE html>
<html>
<head>
    <title>PHP Accounting System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        h1 {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px;
        }
        .container {
            width: 80%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 5px 0;
        }
        .credit {
            color: green;
        }
        .debit {
            color: red;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>PHP Accounting System</h1>

    <?php
    // Defining Abstract Classes and Interfaces
    abstract class Account {
        protected $balance;
        protected $transactions = [];

        abstract public function createTransaction($amount);
        abstract public function getBalance();
    }

    interface TransactionActions {
        public function credit($amount);
        public function debit($amount);
    }

    // Implementing Abstract Factory and Factory Method
    class BusinessAccount extends Account implements TransactionActions {
        public function createTransaction($amount) {
            $this->transactions[] = $amount;
        }

        public function getBalance() {
            return array_sum($this->transactions);
        }

        public function credit($amount) {
            if ($amount > 0) {
                $this->createTransaction($amount);
            }
        }

        public function debit($amount) {
            if ($amount > 0 && $this->getBalance() >= $amount) {
                $this->createTransaction(-$amount);
            } else {
                echo "<p class='debit'>Transaction failed: Insufficient funds or invalid amount.</p>";
            }
        }

    }

    // Create BusinessAccount instances
    $account1 = new BusinessAccount();
    $account2 = new BusinessAccount();

    // Initial transactions
    $account1->credit(1000);
    $account2->credit(500);

    // Transaction Processing
    $account1->debit(300);
    $account2->debit(800);

    // Reporting and Analysis
    echo "<h2>Account 1 Balance: {$account1->getBalance()}</h2>";
    echo "<h2>Account 2 Balance: {$account2->getBalance()}</h2>";

    // Using Loops for Reports
    echo "<h2>Transactions for Account 1:</h2>";
    echo "<ul>";
    foreach ($account1->transactions as $transaction) {
        echo "<li class='debit'>$transaction</li>";
    }
    echo "</ul>";

    echo "<h2>Transactions for Account 2:</h2>";
    echo "<ul>";
    foreach ($account2->transactions as $transaction) {
        echo "<li class='debit'>$transaction</li>";
    }
    echo "</ul>";

    // Applying Conditional Statements
    echo "<h2>Transaction Summary for Account 1:</h2>";
    foreach ($account1->transactions as $transaction) {
        if ($transaction > 0) {
            echo "<p class='credit'>Credit: $transaction</p>";
        } elseif ($transaction < 0) {
            echo "<p class='debit'>Debit: " . abs($transaction) . "</p>";
        } else {
            echo "<p>Zero transaction</p>";
        }
    }

    echo "<h2>Transaction Summary for Account 2:</h2>";
    foreach ($account2->transactions as $transaction) {
        if ($transaction > 0) {
            echo "<p class='credit'>Credit: $transaction</p>";
        } elseif ($transaction < 0) {
            echo "<p class='debit'>Debit: " . abs($transaction) . "</p>";
        } else {
            echo "<p>Zero transaction</p>";
        }
    }
    ?>
</div>
</body>
</html>
