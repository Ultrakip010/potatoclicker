// File: potatoclicker.js

function updateStatus(responseText) {
    const response = JSON.parse(responseText);
    document.getElementById("potatoCount").innerText = response.points + " potatoes";
    document.getElementById("totalPotatoes").innerText = response.totalPotatoes + " total potatoes collected";
    document.getElementById("autoClickerStatus").innerText = response.autoClicker ? "Auto-Clicker is active" : "Auto-Clicker is inactive";
    if (response.autoClicker) {
        document.getElementById("upgradeButton").style.display = "none";
        document.getElementById("speedUpgradeButton").style.display = "inline";
        document.getElementById("speedUpgradeButton").innerText = `Increase Auto-Clicker Speed (${response.speedUpgradeCost} potatoes)`;
    }
    document.getElementById("pointsUpgradeButton").innerText = `Increase Points Per Click (${response.pointsUpgradeCost} potatoes)`;
    document.getElementById("multiplierUpgradeButton").innerText = `Increase Points Multiplier (${response.multiplierUpgradeCost} potatoes)`;
    document.getElementById("autoClickerCountUpgradeButton").innerText = `Increase Auto-Clicker Count (${response.autoClickerCountUpgradeCost} potatoes)`;
    document.getElementById("upgradeCostReductionButton").innerText = `Reduce Upgrade Costs (${response.upgradeCostReductionUpgradeCost} potatoes)`;
    document.getElementById("bonusChanceUpgradeButton").innerText = `Increase Bonus Chance (${response.bonusChanceUpgradeCost} potatoes)`;
    autoClickerInterval = response.autoClickerSpeed;
    clearInterval(autoClickerIntervalId);
    autoClickerIntervalId = setInterval(autoClick, autoClickerInterval);
}

function clickPotato() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "potatoclicker.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            updateStatus(xhr.responseText);
        }
    };
    xhr.send("click=1");
}

function resetPoints() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "potatoclicker.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            updateStatus(xhr.responseText);
            location.reload(); // Refresh the page after resetting
        }
    };
    xhr.send("reset=1");
}

function buyUpgrade() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "potatoclicker.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            updateStatus(xhr.responseText);
        }
    };
    xhr.send("upgrade=1");
}

function buySpeedUpgrade() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "potatoclicker.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            updateStatus(xhr.responseText);
        }
    };
    xhr.send("speedUpgrade=1");
}

function buyPointsUpgrade() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "potatoclicker.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            updateStatus(xhr.responseText);
        }
    };
    xhr.send("pointsUpgrade=1");
}

function buyMultiplierUpgrade() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "potatoclicker.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            updateStatus(xhr.responseText);
        }
    };
    xhr.send("multiplierUpgrade=1");
}

function buyAutoClickerCountUpgrade() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "potatoclicker.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            updateStatus(xhr.responseText);
        }
    };
    xhr.send("autoClickerCountUpgrade=1");
}

function buyUpgradeCostReduction() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "potatoclicker.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            updateStatus(xhr.responseText);
        }
    };
    xhr.send("upgradeCostReduction=1");
}

function buyBonusChanceUpgrade() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "potatoclicker.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            updateStatus(xhr.responseText);
        }
    };
    xhr.send("bonusChanceUpgrade=1");
}

document.getElementById("potatoButton").addEventListener("click", clickPotato);
document.getElementById("resetButton").addEventListener("click", resetPoints);
document.getElementById("upgradeButton").addEventListener("click", buyUpgrade);
document.getElementById("speedUpgradeButton").addEventListener("click", buySpeedUpgrade);
document.getElementById("pointsUpgradeButton").addEventListener("click", buyPointsUpgrade);
document.getElementById("multiplierUpgradeButton").addEventListener("click", buyMultiplierUpgrade);
document.getElementById("autoClickerCountUpgradeButton").addEventListener("click", buyAutoClickerCountUpgrade);
document.getElementById("upgradeCostReductionButton").addEventListener("click", buyUpgradeCostReduction);
document.getElementById("bonusChanceUpgradeButton").addEventListener("click", buyBonusChanceUpgrade);
document.getElementById("settingsButton").addEventListener("click", function() {
    document.getElementById("settingsModal").style.display = "block";
});

document.getElementsByClassName("close")[0].addEventListener("click", function() {
    document.getElementById("settingsModal").style.display = "none";
});

window.addEventListener("click", function(event) {
    if (event.target == document.getElementById("settingsModal")) {
        document.getElementById("settingsModal").style.display = "none";
    }
});

document.getElementById("resetButton").addEventListener("click", resetPoints);

document.getElementById("themeSelector").addEventListener("change", function() {
    document.body.className = this.value;
});

// Load the saved theme from localStorage on page load
document.addEventListener("DOMContentLoaded", function() {
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) {
        document.body.className = savedTheme;
        document.getElementById("themeSelector").value = savedTheme;
    }
});

// Save the selected theme to localStorage when changed
document.getElementById("themeSelector").addEventListener("change", function() {
    const selectedTheme = this.value;
    document.body.className = selectedTheme;
    localStorage.setItem("theme", selectedTheme);
});

// Auto-clicker functionality
let autoClickerInterval = 1000;
let autoClickerIntervalId = setInterval(autoClick, autoClickerInterval);

function autoClick() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "potatoclicker.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("autoclick=1");
}

setInterval(function() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "potatoclicker.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            updateStatus(xhr.responseText);
            autoClickerInterval = response.autoClickerSpeed;
            clearInterval(autoClickerIntervalId);
            autoClickerIntervalId = setInterval(autoClick, autoClickerInterval);
        }
    };
    xhr.send("autoclick=1");
}, autoClickerInterval);