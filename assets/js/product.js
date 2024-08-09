jQuery(document).ready(function($) {

  var showFormButtons = $('#show-form-btn1, #show-form-btn2');
  var measurementForm = $('#measurement-details-form');
  var closeBtn = $('#close-form-btn');
  var overlay = $('#overlay');

  function handleButtonClick() {
      var currentTop = measurementForm.css('display');
      
      if (currentTop === 'none') {
        overlay.fadeIn();
        measurementForm.css('display', 'block');
        highlightInputs(); 
      } else {
        measurementForm.css('display', 'none');
        overlay.fadeOut();
      }
  }

  closeBtn.on('click', handleButtonClick);
  showFormButtons.on('click', handleButtonClick);
  overlay.on('click', handleButtonClick);

  $('#measurement-form').on('submit', function(event) {
      event.preventDefault();
      measurementForm.css('display', 'none');
  });

});


function highlightInputs() {
  highlightWaist();
  highlightChest();
  highlightArm();
}

function inputBoxChecked() {
  document.getElementById('show-form-btn1').checked = true;
}

function highlightWaist() {
  var waistInput = document.getElementById("waist");
  var humanBodyImage = document.getElementById("waist-img");

  if (waistInput.value.trim() !== "") {
    humanBodyImage.style.border = "2px solid red";
  } else {
    humanBodyImage.style.border = "0px solid #ccc";
  }

  waistInput.addEventListener("input", function () {
    if (waistInput.value.trim() !== "") {
      humanBodyImage.style.border = "2px solid red";
    } else {
      humanBodyImage.style.border = "0px solid #ccc";
    }
  });
}

function highlightChest() {
  var chestInput = document.getElementById("chest");
  var humanBodyImage = document.getElementById("chest-img");

  if (chestInput.value.trim() !== "") {
    humanBodyImage.style.border = "2px solid red";
  } else {
    humanBodyImage.style.border = "0px solid #ccc";
  }

  chestInput.addEventListener("input", function () {
    if (chestInput.value.trim() !== "") {
      humanBodyImage.style.border = "2px solid red";
    } else {
      humanBodyImage.style.border = "0px solid #ccc";
    }
  });
}

function highlightArm() {
  var sleevesInput = document.getElementById("sleeves");
  var humanBodyImage = document.getElementById("arm-img");
  var humanBodyImage2 = document.getElementById("arm-img-2");

  if (sleevesInput.value.trim() !== "") {
    humanBodyImage.style.border = "2px solid red";
    humanBodyImage2.style.border = "2px solid red";
  } else {
    humanBodyImage.style.border = "0px solid #ccc";
    humanBodyImage2.style.border = "0px solid #ccc";
  }

  sleevesInput.addEventListener("input", function () {
    if (sleevesInput.value.trim() !== "") {
      humanBodyImage.style.border = "2px solid red";
      humanBodyImage2.style.border = "2px solid red";
    } else {
      humanBodyImage.style.border = "0px solid #ccc";
      humanBodyImage2.style.border = "0px solid #ccc";
    }
  });
}
