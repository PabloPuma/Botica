<?php
// Simple Test Runner

class SimpleTest {
    protected $passed = 0;
    protected $failed = 0;

    public function assert($condition, $message) {
        if ($condition) {
            echo "[PASS] $message\n";
            $this->passed++;
        } else {
            echo "[FAIL] $message\n";
            $this->failed++;
        }
    }

    public function assertEqual($expected, $actual, $message) {
        $this->assert($expected === $actual, "$message (Expected: " . json_encode($expected) . ", Got: " . json_encode($actual) . ")");
    }

    public function getResults() {
        echo "\nResults: {$this->passed} Passed, {$this->failed} Failed.\n";
        return $this->failed === 0;
    }
}
