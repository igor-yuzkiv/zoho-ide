// const x__testInsertCode = document.getElementById("x__testInsertCode");
// x__testInsertCode.addEventListener("click", async () => {
//     const cm = document.querySelector(".CodeMirror").CodeMirror;
//     const doc = cm.getDoc();
//
//     const code = await fetch("https://store.igoryuzkiv.tech/api/test", {
//         method:  "GET",
//         headers: {
//             Accept:         "application/json",
//             "Content-Type": "application/json;charset=UTF-8",
//         }
//     })
//         .then((response) => response.json())
//         .then((data) => data?.code ?? '');
//
//     const currentPosition = doc.getCursor();
//     console.log("currentPosition", currentPosition)
//     doc.replaceRange(code, currentPosition);
// })

console.log(location.href);

document.addEventListener("zohoLazyAss__insertInCurrentPosition", async function (e) {
    console.log("zohoLazyAss__insertInCurrentPosition", {
        location: location.href,
        e
    })
    if (e?.detail) {
        const code = e?.detail;
        const cm = document.querySelector(".CodeMirror").CodeMirror;
        const doc = cm.getDoc();
        const currentPosition = doc.getCursor();
        console.log("currentPosition", currentPosition)
        doc.replaceRange(code, currentPosition);
    }
})
