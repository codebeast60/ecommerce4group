<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Star Rating Form | CodingNepal</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    
     
</head>

<body>
    <div class="rating">
        <div class="post">
            <div class="text">Thanks for rating us!</div>
            <div class="edit">EDIT</div>
        </div>
        <div class="star-widget">
            <h1>rate this item</h1>
            <input type="radio" name="rate_1" id="rate-5">
            <label for="rate-5" class="fas fa-star"></label>
            <input type="radio" name="rate_2" id="rate-4">
            <label for="rate-4" class="fas fa-star"></label>
            <input type="radio" name="rate_3" id="rate-3">
            <label for="rate-3" class="fas fa-star"></label>
            <input type="radio" name="rate_4" id="rate-2">
            <label for="rate-2" class="fas fa-star"></label>
            <input type="radio" name="rate_5" id="rate-1">
            <label for="rate-1" class="fas fa-star"></label>
            <form action="#">
                <header></header>
                <!-- <div class="textarea">
                    <textarea cols="30" placeholder="Describe your experience.."></textarea>
                </div> -->
                <div class="btn">
                    <button type="submit">submit</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const btn = document.querySelector("button");
        const post = document.querySelector(".post");
        const widget = document.querySelector(".star-widget");
        const editBtn = document.querySelector(".edit");
        btn.onclick = () => {
            widget.style.display = "none";
            post.style.display = "block";
            editBtn.onclick = () => {
                widget.style.display = "block";
                post.style.display = "none";
            }
            return false;
        }
    </script>

</body>

</html>