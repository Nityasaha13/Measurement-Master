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
  var humanBodyImage = document.getElementById("human-stomach-part");

  if (waistInput.value.trim() !== "") {
    humanBodyImage.style.fill = "#ff7d16";
  } else {
    humanBodyImage.style.fill = "#57c9d5";
  }

  waistInput.addEventListener("input", function () {
    if (waistInput.value.trim() !== "") {
      humanBodyImage.style.fill = "#ff7d16";
    } else {
      humanBodyImage.style.fill = "#57c9d5";
    }
  });
}

function highlightChest() {
  var chestInput = document.getElementById("chest");
  var humanBodyImage = document.getElementById("human-cheast-part");

  if (chestInput.value.trim() !== "") {
    humanBodyImage.style.fill = "#ff7d16";
  } else {
    humanBodyImage.style.fill = "#57c9d5";
  }

  chestInput.addEventListener("input", function () {
    if (chestInput.value.trim() !== "") {
      humanBodyImage.style.fill = "#ff7d16";
    } else {
      humanBodyImage.style.fill = "#57c9d5";
    }
  });
}

function highlightArm() {
  var sleevesInput = document.getElementById("sleeves");
  var humanBodyImage = document.getElementById("human-arm-part");

  if (sleevesInput.value.trim() !== "") {
    humanBodyImage.style.fill = "#ff7d16";
  } else {
    humanBodyImage.style.fill = "#57c9d5";
  }

  sleevesInput.addEventListener("input", function () {
    if (sleevesInput.value.trim() !== "") {
      humanBodyImage.style.fill = "#ff7d16";
    } else {
      humanBodyImage.style.fill = "#57c9d5";
    }
  });
}
