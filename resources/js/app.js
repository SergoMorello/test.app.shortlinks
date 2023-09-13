function result(link) {
	const modal = document.getElementsByClassName('modal')?.[0];
	const input = document.getElementById('result-link');
	const button = document.getElementById('result-button');
	const close = document.getElementById('reset');
	
	if (!modal || !input || !button || !close) return;
	
	modal.classList.add('show');

	input.value = link;

	button.onclick = () => {
		navigator.clipboard.writeText(link)
	};

	close.onclick = () => {
		modal.classList.remove('show');
	};
}

function submit(e) {
	e.preventDefault();
	const form = e.target;
	const formData = new FormData(form);
	const value = formData.get('link');

	if (!form.action) return;

	form.classList.remove('error');

	if (!validURL(value)) {
		form.classList.add('error');
		return;
	}
	
	fetch(form.action, {
		method: "post",
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/json'
		},
		body: JSON.stringify({
			value
		})
	}).then( (response) => {
		response.json().then(({link}) => {
			const input = form.getElementsByTagName('input')?.[0];
			input.value = '';
			result(link);
		}).catch(() => {
			form.classList.add('error');
		});
	});
}

function validURL(str) {
	var pattern = new RegExp('^(https?:\\/\\/)?'+
		'((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+
		'((\\d{1,3}\\.){3}\\d{1,3}))'+
		'(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+
		'(\\?[;&a-z\\d%_.~+=-]*)?'+
		'(\\#[-a-z\\d_]*)?$','i');
	return !!pattern.test(str);
}

function main() {
	const form = document.getElementsByTagName('form')?.[0];
	if (form) {
		form.onsubmit = submit;
	}
}

document.addEventListener('DOMContentLoaded', main);