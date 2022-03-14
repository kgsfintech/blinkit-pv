Dear Sir/Madam
<br><br>
<p>Your request for an Outstation Conveyance has been  @if($status==0)
    <span><b>Created</b></span>
    @elseif($status==1)
    <span><b>Approved</b></span>
    @elseif($status==2)
    <span ><b>Rejected</b></span>
    @else
    <span><b>Submitted</b></span>
    @endif. Please click <a href="{{url('/outstationconveyance/'.$id)}}"> here </a> to view record</p>
