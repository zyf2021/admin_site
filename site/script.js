function validate_form ()
{
        valid = true;
        alert("Работа функции валидации!")

        if ( ( document.form_appointment.vr[0].checked == false ) && 
        	 ( document.form_appointment.vr[1].checked == false ) )
        {
                alert ( "Пожалуйста, выберите способ отправки ответа на ваше обращение" );
                valid = false;
        }

        if ( document.form_appointment.depart.selectedIndex == 0 )
        {
                alert ( "Пожалуйста, выберите подразделение" );
                valid = false;
        }

        if ( document.form_appointment.terms.checked == false )
        {
                alert ( "Пожалуйста, отметьте согласие с Соглашением." );
                valid = false;
        }
	return valid;
}