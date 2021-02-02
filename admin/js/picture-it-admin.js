(function( $ ) {

	$(function() {
		let rowCount = $("tr.pi-image-size").length;
		const $sizeTable = $("table.pi-image-sizes");
		const $addSizeButton = $('button.add-more-image-sizes');

		$addSizeButton.on('click', function addSizeRow(e) {
			e.preventDefault();
			const newRow = $sizeTable.find('tr.pi-image-size:last-child')[0].cloneNode(true);
			newRow.setAttribute('data-row-id', rowCount);
			const childInputs = newRow.getElementsByTagName('input');
			for (let i = 0; i < childInputs.length; i++) {
				childInputs[i].value = "";
				childInputs[i].name = childInputs[i].name.replace(/(\d+)/, rowCount);
			}
			$sizeTable.append(newRow);
			rowCount++;
		})
	});


})( jQuery );
