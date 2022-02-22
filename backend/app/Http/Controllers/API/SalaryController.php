<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
  public function index()
  {
      return "hello";
  }

  public function calculate(Request $request)
  {
      $generalSalary = $request->salary;
      $salaryDay = $generalSalary / Salary::NORM_DAYS_MONTH;
      $salary = $salaryDay * $request->workedDays;
      $cps = $salary * Salary::TYPE_PERCENT_CPC;
      $ccshi = $salary * Salary::TYPE_PERCENT_CCSHI;
      $cshi = $salary * Salary::TYPE_PERCENT_CSHI;
      $ssc = ($salary - $cps) * Salary::TYPE_PERCENT_SSC;

      if ($request->taxDeduction){
          $minSalary = Salary::MIN_SALARY;
      } else{
          $minSalary = 0;
      }

      if ($salary < Salary::MIDDLE_SALARY_MONTH){
          $iit = ($salary - $cps - $minSalary) * 0.9;
      } else {
          $iit = ($salary - $cps - $minSalary) * 0.1;
      }

      // Индивидуальный подоходный налог (ИПН)
      $iit = ($salary - $cps - $minSalary) * 0.1;

      if ($request->disability && $salary > Salary::TYPE_SALARY_DISABILITY){
          $iit = 0;
      }
      if ($request->pensioner ) {
          $cps = 0;
          $ccshi = 0;
          $cshi = 0;
          $ssc = 0;
      } else if ($request->pensioner && $request->disability){
          $cps = 0;
          $ccshi = 0;
          $cshi = 0;
          $ssc = 0;
      } else if ($request->disabilityCategory == 1 && $request->disabilityCategory == 2) {
          $cps = 0;
          $ccshi = 0;
          $cshi = 0;
      } else if ($request->disabilityCategory == 3){
          $ccshi = 0;
          $cshi = 0;
      }



      $salaryInHand = $salary - $iit - $cps - $ccshi - $cshi - $ssc;

      $response = [
          'salary' => $generalSalary,
          'iit' => $iit,
          'cps' => $cps,
          'ccshi' => $ccshi,
          'cshi' => $cshi,
          'ssc' => $ssc,
          'salaryInHand' => round($salaryInHand, 2, 0),
          ];

    return response()->json($response);
  }

  public function calculateSave(Request $request)
  {
      $salary = new Salary();
      $salary->name = $request->name;
      $salary->salary = $request->salary;
      $salary->iit = $request->iit;
      $salary->cps = $request->cps;
      $salary->ccshi = $request->ccshi;
      $salary->cshi = $request->cshi;
      $salary->ssc = $request->ssc;
      $salary->salaryInHand = $request->salaryInHand;
      $salary->save();

      return response()->json('Успешно записан');

  }

}
