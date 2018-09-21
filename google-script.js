function doPost(e) {

  if (!e) return;

  var sheetID = "GOOGLE_SPREADSHEET_ID";  // Replace this with the Google Spreadsheet ID
  var sheetName = "Form Responses";       // Replace this with the sheet name inside the Spreadsheet

  var status = {};

  // Code based on Martin Hawksey (@mhawksey)'s snippet

  var lock = LockService.getScriptLock();
  lock.waitLock(30000);

  try {

    var sheet = SpreadsheetApp.openById(sheetID).getSheetByName(sheetName);
    var headers = sheet.getRange(1, 1, 1, sheet.getLastColumn()).getValues()[0];

    // Add the data and time when the Gravity Form was submitted
    var column, row = [],
      input = {
        "timestamp": new Date()
      };

    for (var keys in e.parameter) {
      input[normalize_(keys)] = e.parameter[keys];
    }

    for (i in headers) {
      column = normalize_(headers[i])
      row.push(input[column] || "");
    }

    if (row.length) {

      sheet.appendRow(row);
      status = {
        result: "success",
        message: "Row added at position " + sheet.getLastRow()
      };

    } else {
      status = {
        result: "error",
        message: "No data was entered"
      };
    }

  } catch (e) {

    status = {
      result: "error",
      message: e.toString()
    };

  } finally {

    lock.releaseLock();

  }

  return ContentService
    .createTextOutput(JSON.stringify(status))
    .setMimeType(ContentService.MimeType.JSON);

}

function normalize_(str) {
  return str.replace(/[^\w]/g, "").toLowerCase();
}