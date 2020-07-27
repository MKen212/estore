/* eslint-disable no-unused-vars */
// eStore Shared JavaScript Functions

/**
 * copyBillTo function - Copies BillTo values to ShipTo values on Checkout Form
 */
function copyBillTo() {
  document.getElementById("shipFullName").value = document.getElementById("fullName").value;
  document.getElementById("shipAddress1").value = document.getElementById("address1").value;
  document.getElementById("shipAddress2").value = document.getElementById("address2").value;
  document.getElementById("shipCity").value = document.getElementById("city").value;
  document.getElementById("shipRegion").value = document.getElementById("region").value;
  document.getElementById("shipCountryCode").value = document.getElementById("countryCode").value;
  document.getElementById("shipPostcode").value = document.getElementById("postcode").value;
  document.getElementById("shipEmail").value = document.getElementById("email").value;
  document.getElementById("shipContactNo").value = document.getElementById("contactNo").value;
  return;
}

/**
 * updateShipCost function - Copies the selected Shipping Priority VALUE into Shipping Cost
 */
function updateShipCost() {
  document.getElementById("shippingCost").value = document.getElementById("shippingPriority").value;
}