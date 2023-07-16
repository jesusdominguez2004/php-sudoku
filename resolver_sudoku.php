<?php

    function main() {
        define("GRID_SIZE", 9);
    
        $board = array(
            array(7, 0, 2, 0, 5, 0, 6, 0, 0),
            array(0, 0, 0, 0, 0, 3, 0, 0, 0),
            array(1, 0, 0, 0, 0, 9, 5, 0, 0),
            array(8, 0, 0, 0, 0, 0, 0, 9, 0),
            array(0, 4, 3, 0, 0, 0, 7, 5, 0),
            array(0, 9, 0, 0, 0, 0, 0, 0, 8),
            array(0, 0, 9, 7, 0, 0, 0, 0, 5),
            array(0, 0, 0, 2, 0, 0, 0, 0, 0),
            array(0, 0, 7, 0, 4, 0, 2, 0, 3)
        );

        if (solveBoard($board)) {
            echo "Solved successfully!";
        } else {
            echo "Unsolvable board :(";
        }
        
        echo "<br>";
        printBoard($board);
    }

    function printBoard($board) {
        for ($row = 0; $row < GRID_SIZE; $row++) {
            if ($row % 3 == 0 && $row != 0) {
                echo "- - - - - - - - - - -<br>";
            }
            for ($column = 0; $column < GRID_SIZE; $column++) {
                if ($column % 3 == 0 && $column != 0) {
                    echo " | ";
                }
                echo $board[$row][$column];
            }
            echo "<br>";
        }
    }

    function isNumberInRow($board, $number, $row) : bool {
        for ($i = 0; $i < GRID_SIZE; $i++) {
            if ($board[$row][$i] == $number) {
                return true;
            }
        }
        return false;
    }

    function isNumberInColumn($board, $number, $column) : bool {
        for ($i = 0; $i < GRID_SIZE; $i++) {
            if ($board[$i][$column] == $number) {
                return true;
            }
        }
        return false;
    }

    function isNumberInBox($board, $number, $row, $column) : bool {
        $localBoxRow = $row - $row % 3;
        $localBoxColumn = $column - $column % 3;

        for ($i = $localBoxRow; $i < $localBoxRow + 3; $i++) {
            for ($j = $localBoxColumn; $j < $localBoxColumn + 3; $j++) {
                if ($board[$i][$j] == $number) {
                    return true;
                }
            }
        }
        return false;
    }

    function isValidPlacement($board, $number, $row, $column) {
        return !isNumberInRow($board, $number, $row) &&
            !isNumberInColumn($board, $number, $column) &&
            !isNumberInBox($board, $number, $row, $column);
    }

    function solveBoard($board) {
        for ($row = 0; $row < GRID_SIZE; $row++) {
            for ($column = 0; $column < GRID_SIZE; $column++) {
                if ($board[$row][$column] == 0) {
                    for ($numberToTry = 1; $numberToTry <= GRID_SIZE; $numberToTry++) {
                        if (isValidPlacement($board, $numberToTry, $row, $column)) {
                            $board[$row][$column] = $numberToTry;
                            if (solveBoard($board)) {
                                return true;
                            } else {
                                $board[$row][$column] = 0;
                            }
                        }
                    }
                    return false;
                }
            }
        }
        return true;
    }

    // Prueba
    main();
?>