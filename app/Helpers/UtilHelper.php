<?php

namespace App\Helpers;
use DateTime;
use Arr;

class UtilHelper
{
    public static function generateColumnsBetweenDates($startDate, $endDate){
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
    
        $monthColumns = [];

        while ($start <= $end) {
            $monthColumns[] = $start->format('Y_M');
            $start->modify('first day of next month'); // to get next month 
        }

        return $monthColumns;
    }

    public static function prepareCollectionData($clientLoanData, $allColumns){
        $emis = $clientLoanData['num_of_payment'];
        $emi_amount = round($clientLoanData['loan_amount']/$emis, 2);
        $default_amount = $last_emi = 0.00;
        $result['clientid'] = $clientLoanData['clientid'];
        $client_columns = self::generateColumnsBetweenDates($clientLoanData['first_payment_date'], $clientLoanData['last_payment_date']);
        $last_emi = $emi_amount - (($emis * $emi_amount)- $clientLoanData['loan_amount']); 
        foreach ($allColumns as $col) {
            $result[$col] = $default_amount;
            if (in_array($col, $client_columns, 'strcmp')) {
                $result[$col] = $emi_amount;
                if ($emis == 1 && $last_emi > 0) {
                    $result[$col] = round($last_emi, 2);
                }
                $emis--;
            }
        }
        return $result;
    }
}