async function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function injectHtml(file_path, querySelector) {
    await fetch(chrome.runtime.getURL(file_path)).then(r => r.text()).then(html => {
        const node = document.querySelector(querySelector);
        node.insertAdjacentHTML('afterbegin', html)
    });
}

function injectScript(file_path, tag) {
    var node = document.getElementsByTagName(tag)[0];
    var script = document.createElement('script');
    script.setAttribute('type', 'text/javascript');
    script.setAttribute('src', file_path);
    node.appendChild(script);
}

(async () => {
    await injectHtml('embedded/embedded.html', '#delugeEditorEle')
})();

setTimeout(() => injectScript(chrome.runtime.getURL('embedded/embedded.js'), 'body'), 1000)