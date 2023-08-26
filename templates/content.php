<div ID="content">
	  <div>
	   
	  </div>
	  <div ID="form2">
	  <form action="" method="post">
	  <h2>Sign Up!</h2>
	  <table>
	  <tr>
	  <td align ="right" ><strong>Name:</strong></td>
	  <td><input type="text" name="Name" required="required" placeholder="write your name" /></td>
	  </tr>
	  <tr>
	   <td align="right"><strong>Email:</strong></td>
	  <td><input type="email" name="Email" required="required" placeholder="write your email" /></td>
	  </tr>
	  <tr>
	  <td align="right"><strong>Password:</strong></td>
	  <td><input type="password" name="pass" required="required" placeholder="Enter a password" /></td>
	  </tr>
	  <tr>
	  <td align="right" ><strong>Country:</strong></td>
	  <td>
	  <select name="country"> 
	  <option>Select a Country</option>
	  <option>Afghanistan</option> <option>Albania</option> <option>Algeria</option>
	  <option>Andorra</option> <option>Argentina</option> <option>Armenia</option>
	  <option>Austria</option> <option>Azerbaijan</option> <option>Bahrain</option>
	  <option>Bangladesh</option> <option>Belarus</option> <option>Belgium</option>
	  <option>Bhutan</option> <option>Bolivia</option> <option>Bosnia and Herzegovina</option>
	  </tr>
	  <tr>
	  <td align="right"><strong>Gender:</strong></td>
	  <td>
	  <select name="gender">
	  <option>Male</option> <option>Female</option>
	  </select>
	  
	  </td>
	  </tr>
	  <tr>
	  <td align="right"><strong>Birthday:</strong></td>
	  <td><input type="date" name="birthday" required="required"/></td>
	  </tr>
	  <tr>
	  <td colspan="6">
	  <button name="sign_up">Sign Up</button>
	  </td>
	  </tr>
	  </table>
	  </form>
	   <?php include("insert_users.php"); ?>
	  </div>
	
	 
	</div>
