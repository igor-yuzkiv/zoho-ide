async function injectHtml(file_path, querySelector) {
    await fetch(chrome.runtime.getURL(file_path)).then(r => r.text()).then(html => {
        const node = document.querySelector(querySelector);
        node.insertAdjacentHTML('afterbegin', html);
    });
}

function injectScript(file_path, tag = 'body') {
    var node = document.getElementsByTagName(tag)[0];
    var script = document.createElement('script');

    script.setAttribute('type', 'text/javascript');
    script.setAttribute('src', file_path);
    node.appendChild(script);
}

const jsFiles = [
    'embedded/src/toolbar/zla_toolbar.js',
    'embedded/src/zla_eventListener.js',
];

(async () => {
    await injectHtml('embedded/src/toolbar/zla_toolbar.html', '#delugeEditorEle')

    for (const file of jsFiles) {
        injectScript(chrome.runtime.getURL(file), 'body')
    }
})();
