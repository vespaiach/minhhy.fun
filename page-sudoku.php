<?php
/**
 * Template Name: Sudoku
 */

$all_categories = get_categories( array( 'hide_empty' => true, ) );
$recent_posts   = wp_get_recent_posts( array(
	'numberposts' => 5,
	'post_status' => 'publish',
	'orderby' => 'post_date',
	'order' => 'DESC',
), OBJECT );
set_query_var( 'recent_posts', $recent_posts );
set_query_var( 'all_categories', $all_categories );

ob_start();
?>
<script src="https://unpkg.com/react@18/umd/react.development.js"></script>
<script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
<script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
<?php
$extra_head_data = ob_get_clean();
set_query_var( 'extra_head_data', $extra_head_data );

get_header();
?>

<div class="view-port">

	<?php get_sidebar(); ?>

	<main class="flex-1">
		<?= render_top_section( array(
			'line2' => 'Sudoku'
		) ); ?>
		<div id="game-container" class="page"></div>
		<?= get_footer(); ?>
	</main>
</div>

<script type="text/babel">
	function cx(...name) {
		return name.filter(Boolean).map((s) => String(s).trim().replace(/\s+|\n/g, ' ')).join(' ') || undefined
	}

	function isSolved(board) {
		for (let i = 0; i < 9; i++) {
			const rowSet = new Set();
			const colSet = new Set();
			const boxSet = new Set();

			for (let j = 0; j < 9; j++) {
				if (board[i][j] !== 0) {
					if (rowSet.has(board[i][j])) return false;
					rowSet.add(board[i][j]);
				}

				if (board[j][i] !== 0) {
					if (colSet.has(board[j][i])) return false;
					colSet.add(board[j][i]);
				}

				const boxRow = Math.floor(i / 3) * 3 + Math.floor(j / 3);
				const boxCol = (i % 3) * 3 + (j % 3);
				if (board[boxRow][boxCol] !== 0) {
					if (boxSet.has(board[boxRow][boxCol])) return false;
					boxSet.add(board[boxRow][boxCol]);
				}
			}
		}
		return true;
	}

	function isValid(board, row, col, num) {
		for (let x = 0; x < 9; x++) {
			if (board[row][x] === num) {
				return false;
			}
		}

		for (let x = 0; x < 9; x++) {
			if (board[x][col] === num) {
				return false;
			}
		}

		const startRow = row - (row % 3);
		const startCol = col - (col % 3);
		for (let i = 0; i < 3; i++) {
			for (let j = 0; j < 3; j++) {
				if (board[i + startRow][j + startCol] === num) {
					return false;
				}
			}
		}

		return true;
	}

	function solveSudoku(board) {
		for (let i = 0; i < 9; i++) {
			for (let j = 0; j < 9; j++) {
				if (board[i][j] === 0) {
					const numbers = shuffleArray([1, 2, 3, 4, 5, 6, 7, 8, 9]);
					for (let num of numbers) {
						if (isValid(board, i, j, num)) {
							board[i][j] = num; // Try placing the number

							if (solveSudoku(board)) {
								return true; // If it leads to a solution, return true
							}

							board[i][j] = 0; // Otherwise, backtrack
						}
					}
					return false; // No valid number found for this cell
				}
			}
		}
		return true;
	}

	// Fisher-Yates shuffle
	function shuffleArray(array) {
		for (let i = array.length - 1; i > 0; i--) {
			const j = Math.floor(Math.random() * (i + 1));
			[array[i], array[j]] = [array[j], array[i]];
		}
		return array;
	}

	function createPuzzle(board, holes) {
		let puzzle = board.map(row => row.slice());
		let removed = 0;
		const cells = shuffleArray(Array.from({ length: 81 }, (_, i) => [Math.floor(i / 9), i % 9]));

		for (let [r, c] of cells) {
			if (puzzle[r][c] !== 0) {
				puzzle[r][c] = 0;
				removed++;
				if (removed >= holes) {
					break;
				}
			}
		}
		return puzzle;
	}

	function generateSudoku(holes = 1) {
		let board = Array.from({ length: 9 }, () => Array(9).fill(0));
		while (!solveSudoku(board)) { // should not happend ideally
			board = Array.from({ length: 9 }, () => Array(9).fill(0));
		}

		return createPuzzle(board, holes);
	}

	function Input({ cell, onChange }) {
		const inputRef = React.useRef(null);

		React.useEffect(() => {
			inputRef.current.focus();
			inputRef.current.select();
		}, []);

		const handleChange = (e) => {
			const newValue = e.target.value;
			if (newValue === '' || newValue.match(/^[1-9]$/)) {
				cell.value = newValue === '' ? '' : parseInt(newValue, 10);
			}
			onChange(cell);
		};

		const handleKeyDown = (e) => {
			if (e.key === 'Enter') {
				e.preventDefault();
				handleChange(e);
			}
		};

		return (
			<input
				ref={inputRef}
				type="tel"
				value={cell.value}
				onChange={handleChange}
				onKeyDown={handleKeyDown}
				className="w-full h-full text-center border-none outline-none p-0"
				maxLength={1}
			/>
		);
	}

	function Board() {
		const [board, setBoard] = React.useState([]);

		React.useEffect(() => {
			const generatedBoard = generateSudoku();
			setBoard(generatedBoard.map(row => row.map(cell => ({ value: cell === 0 ? '' : String(cell), prefilled: cell !== 0, editing: false }))));
		}, []);

		const disabled = React.useMemo(() => {
			return board.some(row => row.some(cell => cell.value === ''));
		}, [board]);

		const handleCellClick = (rowIndex, colIndex) => {
			if (board[rowIndex][colIndex].prefilled) {
				return;
			}
			const newBoard = board.map((row, r) => row.map((cell, c) => {
				return { ...cell, editing: r === rowIndex && c === colIndex };
			}));
			setBoard(newBoard);
		};

		const handleReset = () => {
			if (confirm('Are you sure you want to reset the game?')) {
				const generatedBoard = generateSudoku();
				setBoard(generatedBoard.map(row => row.map(cell => ({ value: cell === 0 ? '' : String(cell), prefilled: cell !== 0, editing: false }))));
			}
		}

		const handleInputChange = () => {
			setBoard(board => board.map(row => row.slice()));
		}

		const handleDone = () => {
			if (isSolved(board)) {
				alert('Congratulations! You completed the Sudoku!');
			} else {
				alert('Please fill in all cells correctly.');
			}
		}

		return (
			<div className="flex flex-col items-start gap-8">
				<table className="table-fixed">
					<tbody>
						{board.map((row, rowIndex) => (
							<tr key={rowIndex}>
								{row.map((cell, colIndex) => {
									const cellClasses = cx('su-cell',
										colIndex % 3 === 0 && 'border-l-2 border-l-stone-300',
										rowIndex % 3 === 0 && 'border-t-2 border-t-stone-300',
										colIndex === 8 && 'border-r-2 border-r-stone-300',
										rowIndex === 8 && 'border-b-2 border-b-stone-300');

									return (
										<td
											key={colIndex}
											className={cellClasses}
											data-prefilled={cell.prefilled || undefined}
											data-row={rowIndex}
											data-col={colIndex}
											onClick={cell.prefilled ? undefined : () => handleCellClick(rowIndex, colIndex)}
										>
											{cell.prefilled ? cell.value : (cell.editing ? <Input cell={cell} onChange={handleInputChange} /> : cell.value)}
										</td>
									);
								})}
							</tr>
						))}
					</tbody>
				</table>
				<div className="flex gap-3">
					<button disabled={disabled} className="done" onClick={handleDone}>Done</button>
					<button className="text-stone-600" onClick={handleReset}>Reset</button>
				</div>
			</div>
		);
	};

	const root = ReactDOM.createRoot(document.getElementById('game-container'));
	root.render(<Board />);
</script>

</body>

</html>