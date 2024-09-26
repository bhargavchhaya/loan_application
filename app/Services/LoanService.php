<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\LoanRepository;
use App\Helpers\UtilHelper;
use Arr;

class LoanService{

    public function __construct(
        protected LoanRepository $loanRepository)
    {

    }

    public function getLoanListing($params = null){
        return $this->loanRepository->all();
    }

    public function getCollecionSchedule(){
        // Get all loans data
        $loans = $this->loanRepository->all()?->toArray();
        // Extract all first & last payment dates
        $first_payment_dates = array_unique(Arr::pluck($loans, 'first_payment_date'));
        $last_payment_dates = array_unique(Arr::pluck($loans, 'last_payment_date'));
        // Min & Max of payyment dates
        $min_payment_date = min($first_payment_dates);
        $max_payment_date = max($last_payment_dates);
        // Generate dynamic column names based on min & max payment date of entire loan data
        $dynamic_cols = UtilHelper::generateColumnsBetweenDates($min_payment_date, $max_payment_date);
        
        $dynamic_table_data = [];
        // Calculate EMIs for each client and prepare data to insert into Dynamic Table emi_details
        foreach ($loans as $key => $value) {
            $dynamic_table_data[$key] = UtilHelper::prepareCollectionData($value, array_values($dynamic_cols));
        }
        
        $tablename = 'emi_details';
        // Create RAW query for Create table & Create table
        $this->createDynamicTable($tablename, $dynamic_cols);
        // Add data to Table
        $this->addDataToDynamicTable($tablename, $dynamic_table_data);
        // Attach static column to dynamic columns
        array_unshift($dynamic_cols, 'clientid');
        
        return ['headers' => $dynamic_cols, 'data' => $dynamic_table_data];
    }

    public function createDynamicTable($tablename, $dynamic_cols){
        // Static columns that is must for this table
        $static_columns = "
            `id` int AUTO_INCREMENT PRIMARY KEY,
            `clientid` int not null
        ";
        // Dynamic columns varies based on loan Data min & max payment dates
        $dynamic_columns = "";
        foreach ($dynamic_cols as $col) {
            if ($col === end($dynamic_cols)) {
                $dynamic_columns .= "`$col` decimal(9,2) default 0.00 ";
            } else {
                $dynamic_columns .= "`$col` decimal(9,2) default 0.00, ";
            }
        }

        $finalSql = "CREATE TABLE IF NOT EXISTS `{$tablename}` (
                $static_columns,
                $dynamic_columns
            )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        DB::statement($finalSql);
    }

    public function addDataToDynamicTable($tablename, $dynamic_table_data){
        // Insert data into Dynamica Table
        DB::table($tablename)->insert($dynamic_table_data);
    }

}