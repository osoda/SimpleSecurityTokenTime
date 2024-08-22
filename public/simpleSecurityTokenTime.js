$(document).ready(function () {
  $("#btnLoadToken").click(getSecurityToken);
  $("#btnSendToken").click(evalSecurityToken);
  getSecurityToken();
});

function getSecurityToken() {
  $.post("ajax/?action=getSecurityToken", {}).done(function (data) {
    if (data.trim() === "") return;

    data = JSON.parse(data);
    if (data.error != undefined) {
      alert("Error: ", data);
      return;
    }
    $("#securityToken").val(data.token);
    objProgressBar.maxSecondsExpiration = data.maxSecondsExpiration;
    objProgressBar.renderProgressBarExpirationToken(data.secondsToExpirate);
  });
}

function evalSecurityToken() {
  let tokenToEval = $("#tokenToEval").val();
  $.post("ajax/?action=evalSecurityToken", { tokenToEval }).done(function (
    data
  ) {
    if (data.trim() === "") return;

    data = JSON.parse(data);
    if (data.error != undefined) {
      alert("Error: ", data);
      return;
    }

    if (data.isToken) alert("Success: Right Token!");
    else alert("Wrong: Incorrect Token!");
  });
}

const objProgressBar = {
  timerNow: null,
  maxSecondsExpiration: 180,
  renderProgressBarExpirationToken(segundos) {
    if (this.timerNow) clearInterval(this.timerNow);
    display = document.querySelector("#time");
    bar = document.querySelector("#progressBar");
    this._startTimer(segundos, display, bar);
  },

  _startTimer(duration, display, bar) {
    var timer = duration,
      minutes,
      seconds;
    totalSeconds = this.maxSecondsExpiration;

    this.timerNow = setInterval(function () {
      minutes = parseInt(timer / 60, 10);
      seconds = parseInt(timer % 60, 10);

      var remainingSeconds = minutes * 60 + seconds;

      bar.style.width = (remainingSeconds * 100) / totalSeconds + "%";

      minutes = minutes < 10 ? "0" + minutes : minutes;
      seconds = seconds < 10 ? "0" + seconds : seconds;

      display.textContent = minutes + ":" + seconds;

      if (--timer < 0) {
        timer = duration;
        getSecurityToken();
      }
    }, 1000);
  },
};
