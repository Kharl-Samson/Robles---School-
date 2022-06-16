//dropdown medicine table
function seeMoremed_Act(val_see){
     document.querySelectorAll('#sub_tr'+val_see).forEach(st => {
        st.style.display="table-row";
      });

      document.querySelectorAll('#dropright'+val_see).forEach(st => {
        st.style.display="none";
      });
      document.querySelectorAll('#dropdown'+val_see).forEach(st => {
        st.style.display="block";
      });
}

//dropdown medicine table
function seeLessmed_Act(val_see1){
    document.querySelectorAll('#sub_tr'+val_see1).forEach(st => {
       st.style.display="none";
     });

     document.querySelectorAll('#dropright'+val_see1).forEach(st => {
       st.style.display="block";
     });
     document.querySelectorAll('#dropdown'+val_see1).forEach(st => {
       st.style.display="none";
     });
}

