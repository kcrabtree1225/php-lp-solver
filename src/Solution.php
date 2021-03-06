<?php namespace Tchannel\LpSolver;

use Exception;

class Solution
{
    protected $statuses = [
        "-2" => "TIMEOUT",
        "-3" => "USERABORT",
        "0" => "OPTIMAL",
        "1" => "MILP_FAIL",
        "2" => "INFEASIBLE",
        "3" => "UNBOUNDED",
        "4" => "FAILURE",
        "8" => "BREAK_BB",
    ];

    protected $status;
    protected $variables;
    protected $code;

    public function __construct($stat_code, $variables)
    {
        $this->parseStatus($stat_code);
        $this->variables = $variables;
    }


    protected function parseStatus($stat)
    {
        if (!isset($this->statuses[(string) $stat])) {
            throw new Exception("Unknow solver status code: {$stat}");
        }
        $this->code = $stat;
        $this->status = $this->statuses[(string) $stat];
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getVariables()
    {
        return $this->variables;
    }

    public function getCode()
    {
        return $this->code;
    }
}
