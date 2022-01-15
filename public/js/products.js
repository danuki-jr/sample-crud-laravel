document.onreadystatechange = () => {
    if (document.readyState === 'complete') {
        document.getElementById('add').addEventListener('click', (e) => {
            $('#overlay-modal').modal('show');
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '/api/products/add', true);
            xhr.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded');

            let data = {
                name: document.getElementById('name').value,
                description: document.getElementById('description').value
            }

            xhr.onreadystatechange = function () {
                if (this.readyState != 4) return;

                if (this.status == 200) {
                    let data = JSON.parse(this.responseText);

                    let tableRow = document.createElement('TR');
                    tableRow.setAttribute('id', `product-row-${data.id}`);

                    tableRow.innerHTML = `
                        <th scope="row">${data.id}</th>
                        <td id="product-name-${data.id}">${data.name}</td>
                        <td id="product-description-${data.id}">${data.description}</td>
                        <td>
                            <button type="button" id="update-${data.id}" class="btn btn-primary" style="margin-right: 1em;" data-toggle="modal" data-target="#update-modal">UPDATE</button>
                            <button type="button" id="delete-${data.id}" class="btn btn-primary">DELETE</button>
                        </td>
                    `;

                    document.getElementById('tbody').appendChild(tableRow);

                    document.getElementById(`update-${data.id}`).addEventListener('click', (button) => {
                        applyUpdateListener(button.currentTarget.id);
                    });
                    document.getElementById(`delete-${data.id}`).addEventListener('click', (button) => {
                        applyDeleteListener(button.currentTarget.id);
                    })


                    $('#overlay-modal').modal('hide');
                }
            }
            xhr.send(`data=${JSON.stringify(data)}`)
        });

        const applyUpdateListener = (buttonId) => {
            let id = buttonId.split('-')[buttonId.split('-').length - 1];
            document.getElementById('update-id').value = id;
            document.getElementById('update-name').value = document.getElementById(`product-name-${id}`).innerHTML;
            document.getElementById('update-description').value = document.getElementById(`product-description-${id}`).innerHTML;
        }

        Array.from(document.querySelectorAll('.update-product')).forEach((button) => {
            button.addEventListener('click', () => {
                applyUpdateListener(button.id);
            })
        });

        document.getElementById('update-submit').addEventListener('click', () => {
            $('#update-modal').modal('hide');
            $('#overlay-modal').modal('show');
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '/api/products/update', true);
            xhr.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded');

            let data = {
                id: document.getElementById('update-id').value,
                name: document.getElementById('update-name').value,
                description: document.getElementById('update-description').value
            }

            xhr.onreadystatechange = function () {
                if (this.readyState != 4) return;

                if (this.status == 200) {
                    let data = JSON.parse(this.responseText);

                    document.getElementById(`product-name-${data.id}`).innerHTML = data.name;
                    document.getElementById(`product-description-${data.id}`).innerHTML = data.description;
                    $('#overlay-modal').modal('hide');
                }
            }

            xhr.send(`data=${JSON.stringify(data)}`);
        });

        const applyDeleteListener = (buttonId) => {
            $('#overlay-modal').modal('show');
            let id = buttonId.split('-')[buttonId.split('-').length - 1];

            let xhr = new XMLHttpRequest();
            xhr.open('POST', '/api/products/delete', true);
            xhr.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (this.readyState != 4) return;

                if (this.status == 200) {
                    document.getElementById(`product-row-${id}`).remove();
                    $('#overlay-modal').modal('hide');
                }
            }

            xhr.send(`id=${id}`);
        }

        Array.from(document.querySelectorAll('.delete-product')).forEach((button) => {
            button.addEventListener('click', () => {
                applyDeleteListener(button.id);
            })
        });
    }
}
