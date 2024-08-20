const { JSDOM } = require("jsdom");
require('https').globalAgent.options.ca = require('ssl-root-cas').create();
const { DateTime } = require("luxon");
const config = require("./src/database/config");
const mysql = require("mysql");
// Initialize JSOM in the "https://www.bcv.org.ve/" page
// to avoid CORS problems.
const { window } = new JSDOM("", {
  url: "https://www.bcv.org.ve/",
});


const $ = require("jquery")(window);

getHTML();

// You can set here the time for every check in milliseconds, default is 20 minutes (1200000 milliseconds).
setInterval(function () {
  getHTML();
}, 1200000);

function getShortDate() {
  let date = DateTime.now().toLocaleString({
    locale: "es",
    ...Date.DATE_SHORT,
  });

  return date;
}

function getFullDate() {
  let date = DateTime.now().toLocaleString({
    locale: "es",
    ...DateTime.DATETIME_SHORT,
  });

  return date;
}

function getHTML() {
  let date = getShortDate();

  let fullDate = getFullDate();

  $.get("https://www.bcv.org.ve/", function (html) {
    const HTMLElements = $(html).find(
      "#dolar > div > div > div.col-sm-6.col-xs-6.centrado"
    );

    let dollarValueArray = [];

    HTMLElements.each((i, productHTML) => {
      let value = $(productHTML).find("strong").text();

      dollarValueArray.push(value);
    });

    let splitDollarValue = dollarValueArray[0].split(",");

    let fourDigits = splitDollarValue[1].substring(0, 4);

    // For some reason, the value extracted from the bcv page comes with a space in the beginning
    // that's what the .trim() function is for.
    let dollarValue = (splitDollarValue[0] + "," + fourDigits).trim();

    let verificationFlag = false;

    try {
      const connection = mysql.createConnection(config);

      // Verify if the dollar value exist already in the database, if not, insert the new value.
      let sql =
        `SELECT value FROM logs WHERE value = ` + "'" + dollarValue + "' AND date = '" + date + "'";
      connection.query(sql, function (err, result, fields) {
        if (result[0] == null) {
          verificationFlag = true;

          try {
            if (verificationFlag == true) {
              const connection = mysql.createConnection(config);

              let sql =
                "INSERT INTO logs (id, value, date) VALUES ('" +
                null +
                "', '" +
                dollarValue +
                "', '" +
                date +
                "')";
              console.log("Actualización de valor de dólar registrada. " + fullDate);

              connection.query(sql);
              connection.end();
            }
          } catch (error) {
            console.log(error);
          }
        } else {

          console.log("Valor de dólar sin cambios. " + fullDate);
        }
      });
      connection.end();
    } catch (error) {
      console.log(error);
    }
  });
}