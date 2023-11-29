// By default Hide
// document.getElementById("storyTimeBtn").style.visibility = "hidden";
// storyCard.removeAttribute("hidden");
function body_card()
{
    
    let storyCard = document.getElementById("storyTimeBtn");
    
    if(storyCard.hasAttribute("hidden"))
    {
        storyCard.removeAttribute("hidden")
    }
    else
    {
        storyCard.setAttribute("hidden", false);
    }
}

function switch_card(value)
{
    if(value === "myLife")
    {
        document.getElementById("myLife").removeAttribute("hidden");
        document.getElementById("storyTimeBtn").setAttribute("hidden", false);
    }
    else if(value === "storyTime")
    {
        document.getElementById("storyTimeBtn").removeAttribute("hidden");
        document.getElementById("myLife").setAttribute("hidden", false);
    }
    else if(value === "login_Panel")
    {
        document.getElementById("loginPanel").removeAttribute("hidden");
        document.getElementById("registrationPanel").setAttribute("hidden", false);
    }
    else if(value === "register_Panel")
    {
        document.getElementById("registrationPanel").removeAttribute("hidden");
        document.getElementById("loginPanel").setAttribute("hidden", false);
    }
}

function clearBtn()
{
    alert();
    // document.getElementById("storyTitleID").value = "";
    // document.getElementById("storyBodyID").value = "";
}