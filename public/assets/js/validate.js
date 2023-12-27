// function validater(requiredFields) {
//     for (const field of requiredFields) {
//         const value = document.getElementById(field.id).value;
        
//         if (value === '') {
//             Swal.fire(field.message);
//             return false;
//         }
        
//     }

//     return true;
// }

    

//  const isValid = validater(requiredFields);
function getFieldName(field) {
  // Convert field name to user-friendly format
  const words = field.split('_');
  const capitalizedWords = words.map(word => word.charAt(0).toUpperCase() + word.slice(1));
  return capitalizedWords.join(' ');
}