(function ($) {

    $(function () {
        let rowCount = $("tr.pi-image-size").length;
        const $sizeContainer = $("div.pi-image-sizes");
        const $sizeTable = $("table.pi-image-sizes-form")
        const $addSizeButton = $('button.pi-reveal-form');
        const $addAnotherButton = $('button.add-more-image-sizes');

        $addSizeButton.on('click', function revealRow(e) {
            e.preventDefault();
            $sizeContainer.removeClass('hidden');
        })

        $addAnotherButton.on('click', function addSizeRow(e) {
            e.preventDefault();
            const newRow = $sizeTable.find('tr.pi-image-size:last-child')[0].cloneNode(true);
            newRow.setAttribute('data-row-id', rowCount);
            const childInputs = newRow.getElementsByTagName('input');
            for (let i = 0; i < childInputs.length; i++) {
                childInputs[i].value = "";
                childInputs[i].name = childInputs[i].name.replace(/\d+(?!.*\d+)/, rowCount);
            }
            $sizeTable.append(newRow);
            rowCount++;
        });
    });

})(jQuery);
