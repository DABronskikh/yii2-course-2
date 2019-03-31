if (!window.WebSocket) {
    alert("Ваш браузер не поддерживает Веб-сокеты");
}

const webSocket = new WebSocket(`ws:/f.yii2.local:8080?task=${task_id}`);
document.querySelector('#formComments')
    .addEventListener('submit', (event) => {
        let newForm = [...document.querySelectorAll('#formComments input')];
        let Comment = {};
        for (const el of newForm) {
            Comment[el.name] = el.value;
        }
        webSocket.send(JSON.stringify(Comment));
        document.querySelector('#inputComment').value = '';
        event.preventDefault();
        return false;
    });

webSocket.onmessage = function (event) {
    let newComeent = JSON.parse(event.data);
    newComeent = newComeent.map((el) => {
        return `<div>${el.username} | ${el.comment}</div><hr>`
    });
    document.querySelector('.new-comment-WS')
        .insertAdjacentHTML('beforeend', newComeent);
};