async function injectHtml(file_path, querySelector) {
    await fetch(chrome.runtime.getURL(file_path))
        .then(r => r.text())
        .then(html => {
            const node = document.querySelector(querySelector);
            node.insertAdjacentHTML('afterbegin', html);
        });
}

function injectScript(file_path, tag = 'body') {
    const node = document.getElementsByTagName(tag)[0];
    const script = document.createElement('script');

    script.setAttribute('type', 'text/javascript');
    script.setAttribute('src', file_path);
    node.appendChild(script);
}

const jsFiles = [
    'embedded/toolbar/zla_toolbar.js',
    'embedded/zla_eventListener.js',
];

const htmlFiles = [
    'embedded/toolbar/zla_toolbar.html'
];

console.log("location.href", location.href);


async function main() {
    for (const path of htmlFiles) {
        await injectHtml(path, 'body')
    }

    for (const file of jsFiles) {
        injectScript(chrome.runtime.getURL(file), 'body')
    }
}

main();
