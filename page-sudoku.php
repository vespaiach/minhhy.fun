<!-- filepath: /Users/toannguyen/minhhy.fun/wp-content/themes/minhhy.fun/page-sudoku.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudoku Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .sudoku-board {
            display: grid;
            grid-template-columns: repeat(9, 1fr);
            grid-template-rows: repeat(9, 1fr);
            width: 450px;
            height: 450px;
            border: 3px solid black;
        }

        .cell {
            border: 1px solid #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            background-color: #fff;
            position: relative;
        }

        /* Bold borders for 3x3 subgrids */
        .cell:nth-child(3n) {
            border-right: 3px solid black;
        }

        .cell:nth-child(9n+1) {
            border-left: 3px solid black;
        }

        .cell:nth-child(-n+9) {
            border-top: 3px solid black;
        }

        .cell:nth-last-child(-n+9) {
            border-bottom: 3px solid black;
        }

        .cell input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            font-size: 20px;
            text-align: center;
            background-color: transparent;
            outline: none;
        }
    </style>
</head>
<body>
    <div class="sudoku-board">
        <?php
        // Generate 81 cells for the Sudoku board
        for ($i = 0; $i < 81; $i++) {
            echo '<div class="cell" data-index="' . $i . '"></div>';
        }
        ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cells = document.querySelectorAll('.cell');

            cells.forEach(cell => {
                cell.addEventListener('click', () => {
                    // Check if an input already exists
                    if (!cell.querySelector('input')) {
                        const input = document.createElement('input');
                        input.type = 'tel'; // Use 'tel' to open the numeric keypad on mobile
                        input.maxLength = 1; // Allow only one digit
                        input.addEventListener('blur', () => {
                            // On blur, save the value and remove the input
                            const value = input.value;
                            cell.textContent = value.match(/[1-9]/) ? value : ''; // Only allow digits 1-9
                            cell.removeChild(input);
                        });
                        cell.textContent = ''; // Clear the cell content
                        cell.appendChild(input);
                        input.focus(); // Focus the input for immediate typing
                    }
                });
            });
        });
    </script>
</body>
</html>