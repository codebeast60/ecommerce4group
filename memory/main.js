document.querySelector(".control-buttons span").onclick = function() {
    let name = prompt("enter your name");
    if (name == "" || name == null) {
        document.querySelector(".name span").innerHTML = "unknown";
    } else {
        document.querySelector(".name span").innerHTML = name;
    }
    document.querySelector(".control-buttons").style.display = "none";
    blocks.forEach((block) => {
        block.classList.add("is-flipped");
    });
    setTimeout(() => {
        blocks.forEach((block) => {
            block.classList.remove("is-flipped");
            document.getElementById("mario").play();
        });
    }, duration);
};
let showMe = document.querySelector("#show-me");
// show user the picture 3 times
let t = 3;

showMe.onclick = function() {
    if (t > 0) {
        blocks.forEach((block) => {
            block.classList.add("is-flipped");
        });
        setTimeout(() => {
            blocks.forEach((block) => {
                block.classList.remove("is-flipped");
            });
        }, duration);
    }
    t--;
    setTimeout(() => {
        showMe.innerHTML = `show me : ${t}`;
        if (t === 0) {
            showMe.style.display = "none";
        }
    }, duration);
};
let duration = 1000;

let blocksContainer = document.querySelector(".memory-game-blocks");
let blocks = Array.from(blocksContainer.children);
let orderRange = Array.from(blocks.keys());
// shuffle(orderRange);
orderRange.sort(() => Math.random() - 0.5);

blocks.forEach((block, index) => {
    // block => kel el divs
    // index => hewe ter2imon

    block.style.order = orderRange[index];

    block.addEventListener("click", function() {
        flipBlock(block);
        if (tries.innerHTML == 10) {
            document.querySelector(".game-over").style.display = "block";
            document.querySelector("#over").play();
        }
    });
});

// let endGame = blocks.every((block) => block.classList.contains("has-match"));
// console.log(end);
// if (endGame) {
//     document.getElementById("mario").pause();
//     document.getElementById("win").play();
// }

function shuffle(arr) {
    return arr.sort(() => Math.random() - 0.5);
}

function flipBlock(selectBlock) {
    selectBlock.classList.add("is-flipped");
    let allFlippedBlocks = blocks.filter((flippedBlock) =>
        flippedBlock.classList.contains("is-flipped")
    );
    if (allFlippedBlocks.length === 2) {
        stopClicking();
        checkMatchedBlocks(allFlippedBlocks[0], allFlippedBlocks[1]);
    }
}

function stopClicking() {
    blocksContainer.classList.add("no-clicking");
    setTimeout(() => {
        blocksContainer.classList.remove("no-clicking");
    }, duration);
}

let tries = document.querySelector(".tries span");

function checkMatchedBlocks(first, second) {
    if (first.dataset.technology === second.dataset.technology) {
        first.classList.remove("is-flipped");
        second.classList.remove("is-flipped");
        first.classList.add("has-match");
        second.classList.add("has-match");
    } else {
        tries.innerHTML = parseInt(tries.innerHTML) + 1;
        setTimeout(() => {
            first.classList.remove("is-flipped");
            second.classList.remove("is-flipped");
        }, duration);
        document.querySelector("#fail").play();
    }
}