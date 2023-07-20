
 const assetRecordSection = document.querySelector('.asset_r');
 const assetLoanSection = document.querySelector('.asset_l');
 const assetReturnSection = document.querySelector('.asset_re');
 const assetDetailSection = document.querySelector('.asset_d');
 const assetEmployeeSection = document.querySelector('.asset_e');

 // Get the li elements to add event listeners to
 const assetRecordLi = document.querySelector('#asset_record');
 const assetLoanLi = document.querySelector('#asset_loan');
 const assetReturnLi = document.querySelector('#asset_return');
 const assetDetailLi = document.querySelector('#asset_detail');
 const assetEmployeeLi = document.querySelector('#asset_employee');

 // Add click event listeners to the li elements
 assetRecordLi.addEventListener('click', () => {
     assetRecordSection.style.display = 'block';
     assetLoanSection.style.display = 'none';
     assetReturnSection.style.display = 'none';
     assetDetailSection.style.display = 'none';
     assetEmployeeSection.style.display = 'none';
 });

 assetLoanLi.addEventListener('click', () => {
     assetRecordSection.style.display = 'none';
     assetLoanSection.style.display = 'block';
     assetReturnSection.style.display = 'none';
     assetDetailSection.style.display = 'none';
     assetEmployeeSection.style.display = 'none';
 });
 assetReturnLi.addEventListener('click', () => {
    assetRecordSection.style.display = 'none';
    assetLoanSection.style.display = 'none';
    assetReturnSection.style.display = 'block';
     assetDetailSection.style.display = 'none';
     assetEmployeeSection.style.display = 'none';
});
assetDetailLi.addEventListener('click', () => {
    assetRecordSection.style.display = 'none';
    assetLoanSection.style.display = 'none';
    assetReturnSection.style.display = 'none';
    assetDetailSection.style.display = 'block';
    assetEmployeeSection.style.display = 'none';
});
assetEmployeeLi.addEventListener('click', () => {
    assetRecordSection.style.display = 'none';
    assetLoanSection.style.display = 'none';
    assetReturnSection.style.display = 'none';
    assetDetailSection.style.display = 'none';
    assetEmployeeSection.style.display = 'block';
});