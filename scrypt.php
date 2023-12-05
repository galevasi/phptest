<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

// Connect to web driver
$host = 'http://localhost:4444/wd/hub'; // address of your Selenium web driver
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities);

// Define expected text and XPath
$expectedText = "Status: 🟠 Impacted";
$xpathExpression = "//div[2]//div[2]//div[1]//div[1]";

// Define a function to check and play the sound
function checkAndPlaySound($driver, $expectedText, $xpathExpression) {
     $element = $driver->findElement(WebDriverBy::xpath($xpathExpression));

     echo $element->getText() . PHP_EOL;

     if ($element && trim($element->getText()) !== $expectedText) {
         // Play sound (replace URL with your own)
         echo "Opening sound URL..." . PHP_EOL;
         // Add your code to open an audio file or external resource
         // For example: shell_exec('start https://www.youtube.com/watch?...');

         // Stop the interval
         clearInterval();
     }
}

// Defining a function to stop the interval
function clearInterval() {
     global $intervalId;
     if ($intervalId) {
         clearInterval($intervalId);
     }
}

// Set the interval
$intervalId = setInterval('checkAndPlaySound', 5000, $driver, $expectedText, $xpathExpression);

// Delay (example: 30 minutes)
sleep(1800);

// Close the browser and end the interval
$driver->quit();
clearInterval();
