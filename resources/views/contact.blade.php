@extends('layouts.frontend')
@section('content')
    
    <style>
  body{
    background-color: aliceblue;
    
    
  } 
  h2{
    margin-top: 40px;
    padding: 30px;
    
  }
    .formulaire{
            height: 740px;
            width: 45%;
            margin: auto;
            background-color: white;
            padding: px;
            border-radius: 10px;
            margin-top: 40px;
            margin-bottom: 50px;
        }
        form{
            margin: 40px;
        }
        
        #button{
            
           margin-top: 30px;
           background-color: #002B5B;
           width: 90%;
           color:#ffffff;
          
        }
        span{
            color: red;
        }
        h2{
            text-align: center;
        }
        label{
            padding: 10px;
        }
</style>
    <main>
    <h2>Souhaitez-vous en savoir plus sur nos solutions de gestion des files d'attentes ?</h2>
    <div class="formulaire">
    
    <h2>Laissez-nous un message et ous vous répondrons rapidement </h2>
    <form action="" method="post" id="">
        
      <div>
       <label for="nom" >Nom de famille <span>*</span></label> <br>
         <input type="text" name="nom" required>
      </div>

      <div>
       <label for="prenom">Prénom <span>*</span></label> <br>
       <input type="text" name="prenom" required>
      </div>
        <div class="form-group">
         <label for="num">Numero de téléphone <span>*</span></label><br>
         <input type="tel" name="num"  class="form-control"  >
         
          </div>
          <div class="form-group ">
           <label for="email">Email<span>*</span></label><br>
           <input type="email" name="email"  class="form-control" >
          </div>

          <div class="form-group ">
           <label for="entreprise">Nom de l'entreprise<span>*</span></label><br>
           <input type="text" name="entreprise"  class="form-control" >
          </div>
          
          <div class="form-group ">
           <label for="budget">Estimation de votre budget<span>*</span></label><br>
           <select name="budget" id="">
            <option value=""></option>
            <option value="">Moins de 800000</option>
            <option value="">Entre 800000 et 1000000</option>
            <option value="">Entre 1000000 et 2000000</option>
            <option value="">Plus de 2000000</option>
           </select>
          </div>

           <div class="form-group ">
           <label for="demande">Votre demande<span>*</span></label><br>
           <input type="text" name="demande"  class="form-control" >
           <p>Quels sont vos enjeux et les besoins auxquels vous souhaitez répondre ? Êtes-vous encore en phase de réflexion ou avez-vous déjà une échéance définie ?</p>
          </div>
        <button type="submit" class="btn btn-primary" id="button">Envoyer</button>
       
     </form>
     </div>  
     </main>
</body>
</html>
@endsection
