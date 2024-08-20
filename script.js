const { JSDOM } = require("jsdom");
require('https').globalAgent.options.ca = require('ssl-root-cas').create();
const { DateTime } = require("luxon");
const config = require("./src/database/config");
const mysql = require("mysql");

//const $ = require("jquery")(window);

//process.env.NODE_EXTRA_CA_CERTS = config.certPath;


const axios = require('axios');
const cheerio = require('cheerio');

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


getHTMLv2();


async function getHTMLv2() {

    const connection = mysql.createConnection(config);

    try {
        const providers = await query(connection, getProvidersQuery());

        for (const provider of providers) {
            await processProvider(provider, connection);
        }
    } catch (error) {
        handleError(error);
    } finally {
        connection.end();
    }
}

function query(connection, sql) {
    return new Promise((resolve, reject) => {
        connection.query(sql, (err, results) => {
            if (err) return reject(err);
            resolve(results);
        });
    });
}

function getProvidersQuery() {
    return `SELECT id, name, url FROM provider`;
}

function processProvider(provider, connection) {
    
    try {
        const html = fetchProviderHTML(provider.url);
        const $ = cheerio.load(html);
    
        connection.query(getExpressionsQuery(provider.id), (err, expressions) => {
            if (err) return handleError(err);

            expressions.forEach(expression => {
                const currencyValue = findCurrencyValue($, expression);
                if (currencyValue) {
                    handleCurrencyValue(connection, currencyValue, expression, provider);
                } else {
                    logMissingCurrency(provider.name, expression.currency, currencyValue);
                }
            });
        });
    } catch (error) {
        handleError(`Error processing ${provider.name}: ${error.message}`);
    }
}

function fetchProviderHTML(url) {
    return axios.get(url).then(response => response.data);
}

function getExpressionsQuery(providerId) {
    return `SELECT id, htmlsearch, currency FROM search_expression WHERE idprovider = ${providerId}`;
}

function findCurrencyValue($, expression) {
    let currencyValue = null;
    const elements = $(expression.htmlsearch);

    elements.each((i, elem) => {
        currencyValue = $(elem).text().trim();

        console.log(currencyValue);

        currencyValue = currencyValue.match(/[\d,.]+/)[0];
    });

    return currencyValue;
}

function handleCurrencyValue(connection, currencyValue, expression, provider) {
    let date = getShortDate();

    let fullDate = getFullDate();

    connection.query(getLogCheckQuery(currencyValue, date), (err, result) => {
        if (err) return handleError(err);

        if (result.length === 0) {
            insertCurrencyValue(connection, currencyValue, date, provider.id, expression.id);
            logNewCurrencyValue(provider.name, expression.currency, currencyValue, fullDate);
        } else {
            logUnchangedCurrencyValue(provider.name, expression.currency, fullDate);
        }
    });
}

function getLogCheckQuery(currencyValue, date) {
    return `SELECT CurrencyValueInBs FROM logs WHERE CurrencyValueInBs = '${currencyValue}' AND date = '${date}'`;
}

function insertCurrencyValue(connection, currencyValue, date, providerId, expressionId) {
    const insertQuery = `INSERT INTO logs (idProvider, CurrencyValueInBs, date, IdSearchExpression, timestamp) 
        VALUES ('${providerId}','${currencyValue}', '${date}','${expressionId}', NOW())`;
    connection.query(insertQuery, err => {
        if (err) return handleError(err);
    });
}

function handleError(error) {
    console.error(error);
}

function logNewCurrencyValue(providerName, currency, currencyValue, fullDate) {
    console.log(`New ${currency} value from ${providerName}: ${currencyValue} (${fullDate})`);
}

function logUnchangedCurrencyValue(providerName, currency, fullDate) {
    console.log(`${currency} value from ${providerName} unchanged (${fullDate})`);
}

function logMissingCurrency(providerName, currency) {
    console.log(`No ${currency} value found in ${providerName}`);
}
