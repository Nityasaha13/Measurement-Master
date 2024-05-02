jQuery(document).ready(function ($) {
  
  var showFormButton = document.getElementById('show-measurement-form');
  var showFormButton2 = document.getElementById('show-measurement-form2');
  var measurementForm = document.getElementById('measurement-form');

  function handleButtonClick() {
    if (measurementForm.style.top === '-100%') {
        measurementForm.style.top = '0';
        highlightInputs();
    } else {
        measurementForm.style.top = '-100%';
    }
  }

  showFormButton.addEventListener('click', handleButtonClick);
  showFormButton2.addEventListener('click', handleButtonClick);

  document.getElementById('measurement-form').addEventListener('submit', function(event) {
    event.preventDefault();
    measurementForm.style.top = '-100%';
  });
  
  // highlightInputs();
  
});

function highlightInputs() {
  highlightWaist();
  highlightChest();
  highlightArm();
}

function inputBoxChecked() {
  document.getElementById('show-measurement-form').checked = true;
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
