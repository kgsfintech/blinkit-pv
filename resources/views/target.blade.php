<!--Third party Styles(used by this page)-->
<link href="{{ url('backEnd/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet">
<link href="{{ url('backEnd/plugins/select2-bootstrap4/dist/select2-bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{ url('backEnd/plugins/jquery.sumoselect/sumoselect.min.css')}}" rel="stylesheet">
@extends('layouts.app')

@section('content')

<div class="d-flex align-items-center justify-content-center text-center" style="background-image:url('backEnd/image/1108c10e.jpeg'); height:450px; margin-top:-210px;" >


    <div class="form-wrapper m-auto">
    <!-- <div>
                <img src="{{ url('backEnd/image/1108c10e.jpeg')}}" alt="">
            </div> -->
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <div style="background-color:white;">
         <img src="{{ url('backEnd/image/0fc4e385.png')}}" style="width:300px; margin-left:-30px;" alt="">
          <br><br>
            <h4 style="font-weight: 600;">Application for DF Angels</h4>
             <h6>Please fill details of your startup for consideration</h6>
             <br>
            
            <div class="body-content">
               
            <br>
                <form method="POST" action="{{ url('target/store') }}" enctype="multipart/form-data">
                    @csrf
                    @component('backEnd.components.alert')

                  @endcomponent

     <div class="row row-sm">
  <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">Name of your Startup <span style="color:red;">*</span> </label>
            <input type="text"  name="startup_name" value="" class="form-control"
                placeholder="" required>       
          
        </div>
    </div>
    </div>
    <div class="row row-sm">
    <div class="col-12">
    <div class="form-group text-left">
            <label class="font-weight-600">Category </label>
            <br>
            <span>
            Choose an existing category like Fintech, Healthtech etc. If you can't find your category, leave blank.
        </span>
        <br><br>
           
                <select  class="language form-control" name="category">
                    <option value="">Please Select One</option>
					 <option value="AI">AI</option>
                                       <option value="AI powered Assessment tool">AI powered Assessment tool</option>
                    <option value="B2B Fashion & Lifestyle supply chain between manufacturers and retailers, along with credit and consumer origination for their retail partners">B2B Fashion & Lifestyle supply chain between manufacturers and retailers, along with credit and consumer origination for their retail partners</option>
                    <option value="B2B, B2C end to end online logistics">B2B, B2C end to end online logistics</option>
                    <option value="Co-Living & Student Housing">Co-Living & Student Housing</option>
                    <option value="Community cycling">Community cycling</option>
                    <option value="Credit line for micro retailers">Credit line for micro retailers</option>
                    <option value="Education + Fun">Education + Fun</option>
                    <option value="Edutech & Humanoid">Edutech & Humanoid</option>
                    <option value="Free cab ride to restaurants">Free cab ride to restaurants</option>
                    <option value="Guided VR based tours for pilgrims">Guided VR based tours for pilgrims</option>
                    <option value="Interactive White Board">Interactive White Board</option>
                    <option value="IoT Smartpole Supply, Installation, Testing & Commissioning (SITC) for Smart cities">IoT Smartpole Supply, Installation, Testing & Commissioning (SITC) for Smart cities</option>
                    <option value=" Job portal for retail/Hotels (Blue collared)">Job portal for retail/Hotels (Blue collared)</option>
                    <option value="Liquidates surplus material">Liquidates surplus material</option>
                    <option value="Low cost Digital Stethoscope">Low cost Digital Stethoscope</option>
                    <option value="Multilingual platform connecting readers and writers">Multilingual platform connecting readers and writers</option>
                    <option value="Online Grocery">Online Grocery</option>
                    <option value="P2P credit card sharing">P2P credit card sharing</option>
                    <option value="peer to peer counselling -platform">peer to peer counselling -platform</option>
                    <option value="Personal styling">Personal styling</option>
                    <option value="Provision of domestic helps">Provision of domestic helps</option>
                    <option value="Psychological assessment for Alternative credit scoring model">Psychological assessment for Alternative credit scoring model</option>
                    <option value="RBI licensed NBFC P2P fintech">RBI licensed NBFC P2P fintech</option>
                    <option value="Reverse caller tune">Reverse caller tune</option>
                    <option value="Social gaming platform for premium esports titles">Social gaming platform for premium esports titles</option>
                    <option value="sports professional network">sports professional network</option>
                    <option value="Subscription based IoT enabled pre owned cars">Subscription based IoT enabled pre owned cars</option>
                    <option value="Technology driven sports training">Technology driven sports training</option>  
                    <option value="Vernacular Dating app">Vernacular Dating app</option>  
                    <option value="Vernacular online test">Vernacular online test</option>  
                    <option value="Vernacular Translation">Vernacular Translation</option>  
                    <option value="EduTech">EduTech</option> 
                    <option value="IOT">IOT</option> 
                    <option value="FinTech">FinTech</option> 
                    <option value="HealthTech">HealthTech</option> 
                    <option value="HealthCare">HealthCare</option>
                    <option value="Smarthome">Smarthome</option>
                    <option value="Logistic">Logistic</option>
                    <option value="security aand identity management">security aand identity management</option>
                    <option value="CleanTech">CleanTech</option>                   
                </select>
        </div>
    </div>  
</div>
<div class="row row-sm">
<div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">Sub Category </label>
            <br>
            <span>
            (If Any)
        </span>
        <br><br>
            <input type="text"  name="subcategory" value="" class="form-control"
                placeholder="">  
        </div>
    </div>
    </div>  
    <div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">Raising ₹MM <span style="color:red;"> * </span></label>
            <br>
            <span>
            Please enter the capital requested (in million ₹) 
        </span>
        <br><br>
            <input type="number"  name="capital_req" value="" class="form-control"
                placeholder="" required>  
        </div>
    </div>          
</div>
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">Offered stake <span style="color:red;"> * </span></label>
            <br>
            <span>
            % of the stake is being offered againts the investment ask.
        </span>
        <br><br>
            <input type="number"  name="offered_stake" value="" class="form-control"
                placeholder="" required>  
        </div>
    </div>          
</div>
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">Location of the Headquarter <span style="color:red;">*</span></label>
            <input type="text"  name="headquarter_location" value="" class="form-control"
                placeholder="" required>  
        </div>
    </div>          
</div>
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">Deck <span style="color:red;">*</span> </label>
            <br>
            <span>
            Please attach here your pitch deck (pdf is the preffered).
        </span>
        <br><br>
            <input type="file"  name="deck" value="" class="form-control"
                placeholder="" required>  
        </div>
    </div>          
</div>
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">Founder (s) <span style="color:red;">*</span></label>
            <br>
            <span>
            Name(s) of the founder(s)
        </span>
        <br><br>
            <input type="text"  name="founder_name" value="" class="form-control"
                placeholder="" required>  
        </div>
    </div>          
</div>
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">Mobile Number of Founder(s) <span style="color:red;">*</span></label>
            <input type="number"  name="founder_contact" value="" class="form-control"
                placeholder="" required>  
        </div>
    </div>          
</div>
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">Email <span style="color:red;">*</span> </label>
            <br>
            <span>
            Enter your email used for investment communication.
        </span>
        <br><br>
            <input type="email"  name="email" value="" class="form-control"
                placeholder="" required>  
        </div>
    </div>          
</div>
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">Website </label>
            <br>
            <span>
            Your website
        </span>
        <br><br>
            <input type="text"  name="website" value="" class="form-control"
                placeholder="" >  
        </div>
    </div>          
</div>
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">Source <span style="color:red;">*</span> </label>
            <br>
            <span>
            How did you get to know about DF Angels?
        </span>
        <br><br>
            <input type="text"  name="source" value="" class="form-control"
                placeholder="" required>  
        </div>
    </div>          
</div>
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">Problem Statement <span style="color:red;">*</span>  </label>
            <br>
            <span>
            What problem is your startup trying to solve and how?
        </span>
        <br><br>
            <input type="text"  name="problem" value="" class="form-control"
                placeholder="" required>  
        </div>
    </div>          
</div>
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">Market Size <span style="color:red;">*</span>  </label>
            <br>
            <span>
            Is there a big enough market available for this idea?
        </span>
        <br><br>
            <input type="text"  name="marget_size" value="" class="form-control"
                placeholder="" required>  
        </div>
    </div>          
</div>
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">Business Model <span style="color:red;">*</span> </label>
            <br>
            <span>
            Our thesis is B2B or B2B2C. Which category are you in?
        </span>
        <br><br>
                <div class="form-check">
  <input class="form-check-input" type="radio" name="business_model" value="B2B">
  <label class="form-check-label" for="flexRadioDefault1">
  <span class="badge badge-pill badge-success">B2B </span>
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="business_model" value="B2B2C">
  <label class="form-check-label" for="flexRadioDefault1">
  <span class="badge badge-pill badge-primary">B2B2C </span>
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="business_model" value="Other">
  <label class="form-check-label" for="flexRadioDefault1">
  <span class="badge badge-pill badge-primary">Other</span>
  </label>
</div>
        </div>
    </div>          
</div>
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">Can your idea scale through digital media? <span style="color:red;">*</span>  </label>
            <textarea type="text"  name="idea_scale_by_digitalmedia" value="" class="form-control"
                placeholder="" required> </textarea> 
        </div>
    </div>          
</div>
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">How is the product market fit? <span style="color:red;">*</span>  </label>
            <textarea type="text"  name="market_fit" value="" class="form-control"
                placeholder="" required> </textarea> 
        </div>
    </div>          
</div>
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">USP and Patent <span style="color:red;">*</span> </label>
            <br>
            <span>
            What is your USP? Have you applied for any patent or planning to?
        </span>
        <br><br>
            <textarea type="text"  name="usp_and_patent" value="" class="form-control"
                placeholder="" required> </textarea> 
        </div>
    </div>          
</div>
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">Pre-Covid & Post-Covid revenue <span style="color:red;">*</span> </label>
            <br>
            <span>
            Can you share your revenue before COVID and during COVID time?
        </span>
        <br><br>
            <textarea type="text"  name="revenue" value="" class="form-control"
                placeholder="" required> </textarea> 
        </div>
    </div>          
</div>
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">Our Ticket Size and Your Valuation <span style="color:red;">*</span>  </label>
            <br>
            <span>
            DFAN ticket size is 70 Lacs to 1 Crore. Are you fine with it? If yes, at what Valuation and why?
        </span>
        <br><br>
            <textarea type="text"  name="ticket_size_and_valuation" value="" class="form-control"
                placeholder="" required> </textarea> 
        </div>
    </div>          
</div>
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">What is Your Exit Strategy for us? <span style="color:red;">*</span></label>
            <textarea type="text"  name="exit_strategy" value="" class="form-control"
                placeholder="" required> </textarea> 
        </div>
    </div>          
</div> <br> <br> 
<div class="row row-sm">
    <div class="col-12">
        <div class="form-group text-left">
            <label class="font-weight-600">I agree to the following terms <span style="color:red;">*</span></label>
           <br> <br>  
<span>1. DFAN will charge a 2% investment fee (either in form of money or equivalent shares) <br><br>

2. All DFAN investors will be represented individually in the cap table.<br><br>

3. Due Diligence charges (INR 50,000 exclusive of tax) will be paid by the startup directly to DFAN’s Lawyers.</span>
<br><br>	
<div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled">
  <label class="form-check-label" for="flexCheckDisabled">
    
  </label>
</div>
<br>
<br>
                    <button type="submit" class="btn btn-success">Submit</button>				 
					 
                </form>
                </div>
        </div>
    </div>
    
</div>

@endsection