let control = document.querySelector(".control-buttons span");
control.onclick = function() {
    let name = prompt("enter your name to began");
    if (name == null || name == "") {
        document.querySelector(".name span").innerHTML = "unknown";
    } else {
        document.querySelector(".name span").innerHTML = name;
    }
    document.querySelector(".control-buttons").style.display = "none";
};
let blocks = Array.from(
    document.querySelectorAll(".memory-game-blocks .game-block")
);
let orderRange = Array.from(blocks.keys());
orderRange.sort(() => Math.random() - 0.5);
blocks.forEach((block, index) => {
    block.style.order = orderRange[index];

    block.addEventListener("click", function() {
        block.classList.add("is-flipped");
        let allFlippedBlocks = blocks.filter((flippedBlock) =>
            flippedBlock.classList.contains("is-flipped")
        );
        if (allFlippedBlocks.length === 2) {
            document
                .querySelector(".memory-game-blocks")
                .classList.add("no-clicking");
            setTimeout(() => {
                document
                    .querySelector(".memory-game-blocks")
                    .classList.remove("no-clicking");
            }, 1000);
            if (
                allFlippedBlocks[0].dataset.technology ===
                allFlippedBlocks[1].dataset.technology
            ) {
                allFlippedBlocks[0].classList.remove("is-flipped");
                allFlippedBlocks[1].classList.remove("is-flipped");
                allFlippedBlocks[0].classList.add("has-match");
                allFlippedBlocks[1].classList.add("has-match");
            } else {
                setTimeout(() => {
                    allFlippedBlocks[0].classList.remove("is-flipped");
                    allFlippedBlocks[1].classList.remove("is-flipped");
                }, 1000);
            }
        }
    });
});