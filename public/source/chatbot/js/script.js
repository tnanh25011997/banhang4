// nhap tu keyboard
$('.usrInput').on('keyup keypress', function (e) {
	var keyCode = e.keyCode || e.which;
	var text = $(".usrInput").val();
	if (keyCode === 13) {
		if (text == "" || $.trim(text) == '') {
			e.preventDefault();
			return false;
		} else {
			//$(".usrInput").blur();
			$("#paginated_cards").remove();
			setUserResponse(text);
			send(text);
			e.preventDefault();
			return false;
		}
	}
});
// click send
$('.btnsend').click(function(event) {
	var text = $(".usrInput").val();
	
	if (text == "" || $.trim(text) == '') {
		e.preventDefault();
		return false;
	} else {

		//$(".usrInput").blur();
		$("#paginated_cards").remove();
		setUserResponse(text);
		send(text);
		e.preventDefault();
		return false;
	}
	
});


//------------------------------------- Set user response------------------------------------
function setUserResponse(val) {
	var UserResponse = '<img class="userAvatar" src=' + "./source/chatbot/img/userAvatar.jpg" + '><p class="userMsg">' + val + ' </p><div class="clearfix"></div>';
	$(UserResponse).appendTo('.chats').show('slow');
	$(".usrInput").val('');
	scrollToBottomOfResults();
	showBotTyping();
	$('.suggestions').remove();
}

//---------------------------------- Scroll to the bottom of the chats-------------------------------
function scrollToBottomOfResults() {
	var terminalResultsDiv = document.getElementById('chats');
	terminalResultsDiv.scrollTop = terminalResultsDiv.scrollHeight;
}

function send(message) {
	console.log("User Message:", message)
	$.ajax({
		url: 'http://localhost:5005/webhooks/rest/webhook',
		type: 'POST',
		contentType: 'application/json',
		data: JSON.stringify({
			"message": message,
			"sender": "Me"
		}),
		success: function (data, textStatus) {
			if(data != null){
					setBotResponse(data);
			}
			console.log("Rasa Response: ", data, "\n Status:", textStatus)
		},
		error: function (errorMessage) {
			setBotResponse("");
			console.log('Error' + errorMessage);

		}
	});
}

//------------------------------------ Set bot response -------------------------------------
function setBotResponse(val) {
	setTimeout(function () {
		hideBotTyping();
		if (val.length < 1) {
			//if there is no response from Rasa
			msg = 'Sorry, Chatbot không hiểu bạn nói gì';

			var BotResponse = '<img class="botAvatar" src="./source/chatbot/img/logo.png"><p class="botMsg">' + msg + '</p><div class="clearfix"></div>';
			$(BotResponse).appendTo('.chats');

		} else {
			//if we get response from Rasa
			for (i = 0; i < val.length; i++) {
				//check if there is text message
				if (val[i].hasOwnProperty("text")) {
					var BotResponse = '<img class="botAvatar" src="./source/chatbot/img/logo.png"><p class="botMsg">' + val[i].text + '</p><div class="clearfix"></div>';
					$(BotResponse).appendTo('.chats');
				}

				//check if there is image
				if (val[i].hasOwnProperty("image")) {
					var BotResponse = '<div class="singleCard">' +
						'<img class="imgcard" src="' + val[i].image + '">' +
						'</div><div class="clearfix">'
					$(BotResponse).appendTo('.chats').hide().fadeIn(1000);
				}

				//check if there is  button message
				if (val[i].hasOwnProperty("buttons")) {
					addSuggestion(val[i].buttons);
				}
				//check if the response contains "custom" message  
                if (val[i].hasOwnProperty("custom")) {

                    
                    //check if the custom payload type is "listProductCard"
                    if (val[i].custom.payload == "listProductCard") {
                        listProduct = (val[i].custom.data)
                        showCardsCarousel(listProduct);
                        return;
                    }

                   
                }

			}
			scrollToBottomOfResults();
		}

	}, 500);
}


// ------------------------------------------ Toggle chatbot -----------------------------------------------
var flat = 0;
$('#chatbot-button').click(function () {
	$('.chatbot-button').toggle();
	$('.widget').slideToggle("fast");
	if(flat == 0){
		send("I want to talk");
		flat++;
	}
	scrollToBottomOfResults();
});

$('#close').click(function () {
	$('.chatbot-button').toggle();
	$('.widget').toggle();
});




// ------------------------------------------ Suggestions -----------------------------------------------

function addSuggestion(textToAdd) {
	setTimeout(function () {
		var suggestions = textToAdd;
		var suggLength = textToAdd.length;
		$(' <div class="singleCard"> <div class="suggestions"><div class="menu"></div></div></diV>').appendTo('.chats').hide().fadeIn(1000);
		// Loop through suggestions
		for (i = 0; i < suggLength; i++) {
			$('<div class="menuChips" data-payload=\''+(suggestions[i].payload)+'\'>' + suggestions[i].title + "</div>").appendTo(".menu");
		}
		scrollToBottomOfResults();
	}, 1000);
}


// on click of suggestions, get the value and send to rasa
$(document).on("click", ".menu .menuChips", function () {
	var text = this.innerText;
	var payload= this.getAttribute('data-payload');
	console.log("button payload: ",this.getAttribute('data-payload'))
	setUserResponse(text);
	send(payload);
	$('.suggestions').remove(); //delete the suggestions 
});

//====================================== Cards Carousel =========================================

function showCardsCarousel(listProduct) {
    var cards = createCardsCarousel(listProduct);

    $(cards).appendTo(".chats").show();


    if (listProduct.length <= 2) {
    	for (var i = 0; i < listProduct.length; i++) {
    		$(".cards_scroller>div.carousel_cards:nth-of-type(" + i + ")").fadeIn(1000);
    	}
        
    } else {
        for (var i = 0; i < listProduct.length; i++) {
            $(".cards_scroller>div.carousel_cards:nth-of-type(" + i + ")").fadeIn(1000);
        }
        $(".cards .arrow.prev").fadeIn(2000);
        $(".cards .arrow.next").fadeIn(2000);
    }


    scrollToBottomOfResults();

    const card = document.querySelector("#paginated_cards");
    const card_scroller = card.querySelector(".cards_scroller");
    var card_item_size = 225;

    card.querySelector(".arrow.next").addEventListener("click", scrollToNextPage);
    card.querySelector(".arrow.prev").addEventListener("click", scrollToPrevPage);


    // For paginated scrolling, simply scroll the card one item in the given
    // direction and let css scroll snaping handle the specific alignment.
    function scrollToNextPage() {
        card_scroller.scrollBy({
		  top: 0,
		  left: 160,
		  behavior: 'smooth'
		});
    }

    function scrollToPrevPage() {
        card_scroller.scrollBy({
		  top: 0,
		  left: -160,
		  behavior: 'smooth'
		});
    }

}

function createCardsCarousel(listProduct) {

    var cards = "";
    

    for (i = 0; i < listProduct.length; i++) {
        title = listProduct[i].name;
        //ratings = Math.round((listProduct[i].ratings / 5) * 100) + "%";
        price_test = listProduct[i].promotion_price;
        //for local
        price_test2 = price_test.toString();

        price = price_test2.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

        arrImg = JSON.parse(listProduct[i].image);
        img = arrImg[0];
        slug = listProduct[i].slug;
        data = listProduct[i];
        item = '<div class="carousel_cards in-left">' + '<img class="cardBackgroundImage" src="http://localhost/banhang/public/source/images/' + img + '"><div class="cardFooter">' + '<a class="cardTitle" href="http://localhost/banhang/public/chi-tiet-san-pham/'+slug+'" target="_blank">' + title + "</a> " + '<div class="cardDescription">' + price +  " VNĐ</div>" + "</div>" + "</div>";

        cards += item;
    }

    var cardContents = '<div id="paginated_cards" class="cards"> <div class="cards_scroller">' + cards + '  <span class="arrow prev fa fa-chevron-circle-left in-left"></span> <span class="arrow next fa fa-chevron-circle-right in-left"></span> </div> </div>';

    return cardContents;
}

//======================================bot typing animation ======================================
function showBotTyping() {

    var botTyping = '<img class="botAvatar" id="botAvatar" src="./source/chatbot/img/logo.png"/><div class="botTyping">' + '<div class="jump1"></div>' + '<div class="jump2"></div>' + '<div class="jump3"></div>' + '</div>'
    $(botTyping).appendTo(".chats");
    $('.botTyping').show();
    scrollToBottomOfResults();
}

function hideBotTyping() {
    $('#botAvatar').remove();
    $('.botTyping').remove();
}
