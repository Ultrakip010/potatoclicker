<?php
session_start();
class CookieClicker {
    private $points;
    private $totalPotatoes;
    private $autoClicker;
    private $autoClickerSpeed;
    private $speedUpgradeCost;
    private $pointsPerClick;
    private $pointsUpgradeCost;
    private $totalPointsMultiplier;
    private $multiplierUpgradeCost;
    private $autoClickerCount;
    private $autoClickerCountUpgradeCost;
    private $upgradeCostReduction;
    private $upgradeCostReductionUpgradeCost;
    private $bonusChance;
    private $bonusChanceUpgradeCost;

    public function __construct() {
        if (!isset($_SESSION['points'])) {
            $_SESSION['points'] = 0;
        }
        if (!isset($_SESSION['totalPotatoes'])) {
            $_SESSION['totalPotatoes'] = 0;
        }
        if (!isset($_SESSION['autoClicker'])) {
            $_SESSION['autoClicker'] = false;
        }
        if (!isset($_SESSION['autoClickerSpeed'])) {
            $_SESSION['autoClickerSpeed'] = 1000; // Default speed: 1 click per second
        }
        if (!isset($_SESSION['speedUpgradeCost'])) {
            $_SESSION['speedUpgradeCost'] = 20; // Initial cost for speed upgrade
        }
        if (!isset($_SESSION['pointsPerClick'])) {
            $_SESSION['pointsPerClick'] = 1; // Default points per click
        }
        if (!isset($_SESSION['pointsUpgradeCost'])) {
            $_SESSION['pointsUpgradeCost'] = 15; // Initial cost for points per click upgrade
        }
        if (!isset($_SESSION['totalPointsMultiplier'])) {
            $_SESSION['totalPointsMultiplier'] = 1; // Default multiplier
        }
        if (!isset($_SESSION['multiplierUpgradeCost'])) {
            $_SESSION['multiplierUpgradeCost'] = 50; // Initial cost for multiplier upgrade
        }
        if (!isset($_SESSION['autoClickerCount'])) {
            $_SESSION['autoClickerCount'] = 1; // Default auto-clicker count
        }
        if (!isset($_SESSION['autoClickerCountUpgradeCost'])) {
            $_SESSION['autoClickerCountUpgradeCost'] = 30; // Initial cost for auto-clicker count upgrade
        }
        if (!isset($_SESSION['upgradeCostReduction'])) {
            $_SESSION['upgradeCostReduction'] = 1; // Default no reduction
        }
        if (!isset($_SESSION['upgradeCostReductionUpgradeCost'])) {
            $_SESSION['upgradeCostReductionUpgradeCost'] = 40; // Initial cost for upgrade cost reduction
        }
        if (!isset($_SESSION['bonusChance'])) {
            $_SESSION['bonusChance'] = 0; // Default no bonus chance
        }
        if (!isset($_SESSION['bonusChanceUpgradeCost'])) {
            $_SESSION['bonusChanceUpgradeCost'] = 25; // Initial cost for bonus chance upgrade
        }
        $this->points = &$_SESSION['points'];
        $this->totalPotatoes = &$_SESSION['totalPotatoes'];
        $this->autoClicker = &$_SESSION['autoClicker'];
        $this->autoClickerSpeed = &$_SESSION['autoClickerSpeed'];
        $this->speedUpgradeCost = &$_SESSION['speedUpgradeCost'];
        $this->pointsPerClick = &$_SESSION['pointsPerClick'];
        $this->pointsUpgradeCost = &$_SESSION['pointsUpgradeCost'];
        $this->totalPointsMultiplier = &$_SESSION['totalPointsMultiplier'];
        $this->multiplierUpgradeCost = &$_SESSION['multiplierUpgradeCost'];
        $this->autoClickerCount = &$_SESSION['autoClickerCount'];
        $this->autoClickerCountUpgradeCost = &$_SESSION['autoClickerCountUpgradeCost'];
        $this->upgradeCostReduction = &$_SESSION['upgradeCostReduction'];
        $this->upgradeCostReductionUpgradeCost = &$_SESSION['upgradeCostReductionUpgradeCost'];
        $this->bonusChance = &$_SESSION['bonusChance'];
        $this->bonusChanceUpgradeCost = &$_SESSION['bonusChanceUpgradeCost'];
    }

    public function click() {
        $bonus = (rand(0, 100) < $this->bonusChance) ? $this->pointsPerClick : 0;
        $this->points += ($this->pointsPerClick + $bonus) * $this->totalPointsMultiplier;
        $this->totalPotatoes += ($this->pointsPerClick + $bonus) * $this->totalPointsMultiplier;
    }

    public function reset() {
        $this->points = 0;
        $this->totalPotatoes = 0;
        $this->autoClicker = false;
        $this->autoClickerSpeed = 1000;
        $this->speedUpgradeCost = 20;
        $this->pointsPerClick = 1;
        $this->pointsUpgradeCost = 15;
        $this->totalPointsMultiplier = 1;
        $this->multiplierUpgradeCost = 50;
        $this->autoClickerCount = 1;
        $this->autoClickerCountUpgradeCost = 30;
        $this->upgradeCostReduction = 1;
        $this->upgradeCostReductionUpgradeCost = 40;
        $this->bonusChance = 0;
        $this->bonusChanceUpgradeCost = 25;
    }

    public function buyUpgrade() {
        if ($this->points >= 10) {
            $this->points -= 10;
            $this->autoClicker = true;
        }
    }

    public function buySpeedUpgrade() {
        if ($this->points >= $this->speedUpgradeCost) {
            $this->points -= $this->speedUpgradeCost;
            $this->autoClickerSpeed = max(50, $this->autoClickerSpeed * 0.8); // Reduce interval by 20%, minimum 50ms
            $this->speedUpgradeCost = ceil($this->speedUpgradeCost * 1.5); // x1.5 cost increase, rounded up
        }
    }

    public function buyPointsUpgrade() {
        if ($this->points >= $this->pointsUpgradeCost) {
            $this->points -= $this->pointsUpgradeCost;
            $this->pointsPerClick = ceil($this->pointsPerClick * 1.5); // increase points per click by 50%, rounded up
            $this->pointsUpgradeCost = ceil($this->pointsUpgradeCost * 1.2); // Increase the cost by 20%, rounded up
        }
    }

    public function buyMultiplierUpgrade() {
        if ($this->points >= $this->multiplierUpgradeCost) {
            $this->points -= $this->multiplierUpgradeCost;
            $this->totalPointsMultiplier = ceil($this->totalPointsMultiplier * 1.5); // increase multiplier by 50%, rounded up
            $this->multiplierUpgradeCost = ceil($this->multiplierUpgradeCost * 1.3); // Increase the cost by 30%, rounded up
        }
    }

    public function buyAutoClickerCountUpgrade() {
        if ($this->points >= $this->autoClickerCountUpgradeCost) {
            $this->points -= $this->autoClickerCountUpgradeCost;
            $this->autoClickerCount++;
            $this->autoClickerCountUpgradeCost = ceil($this->autoClickerCountUpgradeCost * 1.5); // x1.5 cost increase, rounded up
        }
    }

    public function buyUpgradeCostReduction() {
    if ($this->points >= $this->upgradeCostReductionUpgradeCost) {
        $this->points -= $this->upgradeCostReductionUpgradeCost;
        $this->upgradeCostReduction *= 0.9; // Reduce cost by 10%
        $this->speedUpgradeCost = ceil($this->speedUpgradeCost * 0.9);
        $this->pointsUpgradeCost = ceil($this->pointsUpgradeCost * 0.9);
        $this->multiplierUpgradeCost = ceil($this->multiplierUpgradeCost * 0.9);
        $this->autoClickerCountUpgradeCost = ceil($this->autoClickerCountUpgradeCost * 0.9);
        $this->bonusChanceUpgradeCost = ceil($this->bonusChanceUpgradeCost * 0.9);
        $this->upgradeCostReductionUpgradeCost = ceil($this->upgradeCostReductionUpgradeCost * 1.5); // x1.5 cost increase, rounded up
    }
}

    public function buyBonusChanceUpgrade() {
        if ($this->points >= $this->bonusChanceUpgradeCost) {
            $this->points -= $this->bonusChanceUpgradeCost;
            $this->bonusChance = min(100, $this->bonusChance + 5); // Increase bonus chance by 5%, max 100%
            $this->bonusChanceUpgradeCost = ceil($this->bonusChanceUpgradeCost * 1.5); // x1.5 cost increase, rounded up
        }
    }

    public function getPoints() {
        return $this->points;
    }

    public function getTotalPotatoes() {
        return $this->totalPotatoes;
    }

    public function isAutoClickerActive() {
        return $this->autoClicker;
    }

    public function getAutoClickerSpeed() {
        return $this->autoClickerSpeed;
    }

    public function getSpeedUpgradeCost() {
        return $this->speedUpgradeCost;
    }

    public function getPointsPerClick() {
        return $this->pointsPerClick;
    }

    public function getPointsUpgradeCost() {
        return $this->pointsUpgradeCost;
    }

    public function getTotalPointsMultiplier() {
        return $this->totalPointsMultiplier;
    }

    public function getMultiplierUpgradeCost() {
        return $this->multiplierUpgradeCost;
    }

    public function getAutoClickerCount() {
        return $this->autoClickerCount;
    }

    public function getAutoClickerCountUpgradeCost() {
        return $this->autoClickerCountUpgradeCost;
    }

    public function getUpgradeCostReduction() {
        return $this->upgradeCostReduction;
    }

    public function getUpgradeCostReductionUpgradeCost() {
        return $this->upgradeCostReductionUpgradeCost;
    }

    public function getBonusChance() {
        return $this->bonusChance;
    }

    public function getBonusChanceUpgradeCost() {
        return $this->bonusChanceUpgradeCost;
    }

    public function autoClick() {
        if ($this->autoClicker) {
            $bonus = (rand(0, 100) < $this->bonusChance) ? $this->pointsPerClick : 0;
            $this->points += ($this->pointsPerClick + $bonus) * $this->totalPointsMultiplier * $this->autoClickerCount;
            $this->totalPotatoes += ($this->pointsPerClick + $bonus) * $this->totalPointsMultiplier * $this->autoClickerCount;
        }
    }
}

$clicker = new CookieClicker();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['click'])) {
        $clicker->click();
    } elseif (isset($_POST['reset'])) {
        $clicker->reset();
    } elseif (isset($_POST['upgrade'])) {
        $clicker->buyUpgrade();
    } elseif (isset($_POST['speedUpgrade'])) {
        $clicker->buySpeedUpgrade();
    } elseif (isset($_POST['pointsUpgrade'])) {
        $clicker->buyPointsUpgrade();
    } elseif (isset($_POST['multiplierUpgrade'])) {
        $clicker->buyMultiplierUpgrade();
    } elseif (isset($_POST['autoClickerCountUpgrade'])) {
        $clicker->buyAutoClickerCountUpgrade();
    } elseif (isset($_POST['upgradeCostReduction'])) {
        $clicker->buyUpgradeCostReduction();
    } elseif (isset($_POST['bonusChanceUpgrade'])) {
        $clicker->buyBonusChanceUpgrade();
    } elseif (isset($_POST['autoclick'])) {
        $clicker->autoClick();
    }
    echo json_encode([
        'points' => $clicker->getPoints(),
        'totalPotatoes' => $clicker->getTotalPotatoes(),
        'autoClicker' => $clicker->isAutoClickerActive(),
        'autoClickerSpeed' => $clicker->getAutoClickerSpeed(),
        'speedUpgradeCost' => $clicker->getSpeedUpgradeCost(),
        'pointsPerClick' => $clicker->getPointsPerClick(),
        'pointsUpgradeCost' => $clicker->getPointsUpgradeCost(),
        'totalPointsMultiplier' => $clicker->getTotalPointsMultiplier(),
        'multiplierUpgradeCost' => $clicker->getMultiplierUpgradeCost(),
        'autoClickerCount' => $clicker->getAutoClickerCount(),
        'autoClickerCountUpgradeCost' => $clicker->getAutoClickerCountUpgradeCost(),
        'upgradeCostReduction' => $clicker->getUpgradeCostReduction(),
        'upgradeCostReductionUpgradeCost' => $clicker->getUpgradeCostReductionUpgradeCost(),
        'bonusChance' => $clicker->getBonusChance(),
        'bonusChanceUpgradeCost' => $clicker->getBonusChanceUpgradeCost()
    ]);
    exit;
}

// Auto-clicker functionality
if ($clicker->isAutoClickerActive()) {
    $clicker->autoClick();
}