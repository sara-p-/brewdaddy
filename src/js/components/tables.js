export default function mobileTables() {
	// This function takes a normal table and converts each table row into it's own smaller table. This makes it easier to read on mobile. It also looks way better.

	// **************** Variables ********************
	var tablesTurnedToMobile = false;
	var allTables = document.querySelectorAll(`[data-mobile-table="true"]`);
	console.log(allTables);
	var windowBreakpoint = 800;

	// *************** Functions *********************
	// Function to pull the data out of the table and group it in arrays depending on the original row the data came from
	function tableData(table, tableNumber, originalArray) {
		//   Grab all the rows of the table
		var rows = table.rows;
		//   Create an empty array to hold each row's children
		var rowArray = [];
		//   Loop through the rows, and store each row's children in the new array
		for (var i = 0; i < rows.length; i++) {
			rowArray.push(rows[i].children);
		}
		//   The first index will hold the array of table headings, so let's splice that from the rowArray into it's own array
		var headingRow = rowArray.splice(0, 1);
		//   This is now an array of HTML objects, but we need their innerText. First let's navigate to the actual array that holds the HTML Objects
		var headings = headingRow[0];
		//   Now we have an array of just the HTML Objects. Let's create a new array to hold our innerText values
		var headingsArray = [];
		//   Loop through the headings and store the innerText into the new array
		for (var x = 0; x < headings.length; x++) {
			headingsArray[x] = headings[x].innerText;
		}
		//   Now we have our Heading values stored in our new array, and ready for use.

		//   Next let's move on to the td values in the rest of the table
		//   Let's create two new empty arrays to hold the values we will loop though.
		var tdArray = [];
		var newArray = [];
		//   This is the tricky part. We need each table row of innerText values to remain grouped in it's own array, rather than having all of the values dumped together in one larger array
		//   Loop through the first array
		for (var y = 0; y < rowArray.length; y++) {
			//     Loop through the inner array
			for (x = 0; x < rowArray[y].length; x++) {
				//       Store the innerText of each inner array element in the newArray
				newArray[x] = rowArray[y][x].innerText;
			}
			//     Go back up one level, and push the newArray with the innerText values into the tdArray
			tdArray.push(newArray);
			//     IMPORTANT: empty the newArray after each loop so that the values of the next loop won't override the old values.
			newArray = [];
		}
		//   Now we can loop through our tdArray and create a table for each row of the original table
		tdArray.forEach((element, index) => {
			createNewMobileTable(
				tdArray,
				headingsArray,
				index,
				tableNumber,
				originalArray
			);
		});
	}

	// Function to build the actual new mobile table elements and fill them with data
	function createNewMobileTable(
		tdArray,
		headingsArray,
		number,
		tableNumber,
		originalArray
	) {
		//   Create the new table
		var newTable = document.createElement("table");
		newTable.classList.add(
			"mobile-table",
			"table-" + tableNumber + "-" + number
		);
		//   Create the new tBody
		var newTbody = document.createElement("tbody");
		newTable.appendChild(newTbody);

		//   Create the rows and fill the first cell of each row with the Headings
		for (var x = 0; x < headingsArray.length; x++) {
			//   Create the new row
			var newRow = document.createElement("tr");
			newTbody.appendChild(newRow);
			//  Create the first cell
			var firstCell = document.createElement("td");
			newRow.appendChild(firstCell);

			//  Loop through the Headings and add them to the first cell
			firstCell.innerText = headingsArray[x];

			// Create the second cell
			var secondCell = document.createElement("td");
			firstCell.after(secondCell);
		}

		//   Grab the 2nd cell of each row
		var secondCells = newTable.querySelectorAll("td:last-child");
		//   Loop through the cells and input the tdArray values into them
		for (var z = 0; z < secondCells.length; z++) {
			secondCells[z].innerText = tdArray[number][z];
		}

		//   insert the new table after the original table first, and then after the following tables in order
		var table = originalArray[tableNumber];
		if (number > 0) {
			table = document.querySelector(
				`.table-${tableNumber}-${number - 1}`
			);
		}
		table.after(newTable);

		//     Finally, hide the original table
		originalArray[tableNumber].style.display = "none";

		//     Set our origial varible to "true", so that we know the function has run
		tablesTurnedToMobile = true;
	}

	// Function to delete the mobile tables and show the desktop tables again
	function backToDesktop(allTables) {
		if (tablesTurnedToMobile) {
			var allMobileTables = document.querySelectorAll(
				"table.mobile-table"
			);
			if (allMobileTables.length) {
				allMobileTables.forEach((element, index) => {
					element.remove();
				});
				allTables.forEach((element, index) => {
					element.style.display = "table";
				});
			}
			tablesTurnedToMobile = false;
		}
	}

	// Function to check the status of our original variable, as well as the window height, to determine which functions need to run
	function runTheOtherFunctions(windowWidth) {
		if (!tablesTurnedToMobile) {
			if (window.innerWidth <= windowWidth) {
				allTables.forEach((element, index) => {
					tableData(element, index, allTables);
				});
			}
		} else {
			if (window.innerWidth >= windowWidth + 1) {
				backToDesktop(allTables);
			}
		}
	}

	// ********************* Running the script ********************
	// run functions on load
	runTheOtherFunctions(windowBreakpoint);

	// run functions on window resize
	window.addEventListener("resize", function () {
		runTheOtherFunctions(windowBreakpoint);
	});
}
