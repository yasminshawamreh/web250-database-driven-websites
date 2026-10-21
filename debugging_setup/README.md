# WEB-250 — Debugging Setup

This README documents my observations while using VS Code and Xdebug to debug PHP programs.

## Local setup

- Operating system and local server: Mac / MAMP 6.8
- PHP version: 8.2.0
- Xdebug version: 3.2.0RC2 (confirmed in Terminal)
- Active `php.ini` path: `/Applications/MAMP/bin/php/php8.2.0/conf/php.ini` (confirmed for Terminal PHP)
- Xdebug / VS Code port: 9003
- Local Apache port: 55000
- Mac/MAMP FastCGI `-idle-timeout 600` configured? No. The existing directive was not found in my MAMP Apache configuration.
- Mac/MAMP 45-second breakpoint test: Passed. I waited 45 seconds at a breakpoint, then successfully used Step Over and Continue without an HTTP 500 error.
- Local exercise index URL: `http://localhost:55000/web250/debugging_setup/index.php`
- Hosted exercise index URL: Not uploaded yet.

## Exercise 01 — Variables and Watch

- Prediction for `$observations` before the `+=` line: 3
- Value before Step Over: 3
- Value after Step Over: 5
- What I learned: The breakpoint pauses the code before the line executes. I used Variables and Watch to see the current value, then Step Over to see how it changed.
- Screenshot: `evidence/01_variables.png` — Shows the breakpoint and the value of `$observations` in the debugger.

## Exercise 02 — Loop and conditional breakpoint

- Predicted total and average: 10 sightings and an average of 2.50.
- `$total` after the first two iterations: 2 and 6.
- Values when `$dayIndex === 2`: `$dayIndex = 2`, `$count = 1`, and `$total = 6`.
- Why the conditional breakpoint helped: It allowed me to pause only on the third iteration instead of stopping every time the loop ran. This made it easier to inspect the values I needed.
- Screenshot: `evidence/02_conditional.png` — Shows the conditional breakpoint with `$total = 6` before the third count is added.

## Exercise 03 — Step Into / Step Out / Call Stack

- Predicted output: `Eastern Towhee: 2 sightings`
- Which function called `formatObservation()`? The `describeBird()` function.
- What Step Into showed that Step Over would skip: Step Into allowed me to enter the functions and see how they worked. Step Over would execute the function call without showing the code inside.
- Where Step Out returned me: From `formatObservation()` to `describeBird()`, then back to the main PHP script.
- Screenshot: `evidence/03_call_stack.png` — Shows the debugger paused inside `formatObservation()` with the Call Stack displaying the functions.

## Exercise 04 — Find and fix the bug

- Original incorrect browser output: `Birds counted: 4`
- Values observed while stepping through the loop:
  - First iteration: `$count = 2`, `$total` changed from 0 to 2.
  - Second iteration: `$count = 3`, `$total` changed from 2 to 3.
  - Third iteration: `$count = 4`, `$total` changed from 3 to 4.
- Original error and minimal correction: The original code used `$total = $count;`, which replaced the total during each iteration instead of adding the counts together. I corrected it to `$total += $count;` and added a comment explaining the mistake.
- Corrected output: `Birds counted: 9`
- Why PHP did not raise an exception: The original code was valid PHP, but the logic was incorrect. PHP could execute it without an error even though the final result was wrong.
- What Watch revealed: Watch showed that the total was being replaced during each iteration instead of increasing. The final browser output alone did not show where the mistake happened.
- Screenshot: `evidence/04_fixed_bug.png` — Shows the conditional breakpoint with `$count = 4` and `$total = 5` before the final count is added.

## How to view this project

- Local: Open `web250/debugging_setup/index.php` through MAMP.
- Webhost: Open the course index and follow the Debugging Setup link once published.
- GitHub: Link to this folder on `main` in the Moodle Comments area.

**Safety reminder:** Never commit or deploy `php.ini`, `_local_phpinfo.php`, credentials, or logs. The `.vscode/launch.json`, README, and evidence screenshots belong on GitHub, not on the public webhost.
