
@extends('backEnd.layouts.layout') @section('backEnd_content')

<div class="body-content">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Checklist Task</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body" >
                    <fieldset class="form-group">

                        <table class="table display table-bordered table-striped table-hover">

                            <tbody>
                                <tr>
                                    <td><b>Client Name : </b></td>
                                    <td>{{ $assignmentbudget->client_name }}</td>
                                    <td><b>Assignment Code :</b></td>
                                    <td>{{ $assignmentbudget->assignmentgenerate_id }}</td>

                                </tr>
                                <tr>
                                    <td><b>Assignment Name : </b></td>
                                    <td>{{ $auditChecklistDatas->assignment_name}}</td>
                                    <td><b>Financial Statement Classification Name :</b></td>
                                    <td>{{$financialname->financial_name}}</td>

                                </tr>
                              
                                <tr>
                                    <td><b>Sub  Financial Classfication Name :</b></td>
                                    <td>{{ $subclassficationname->subclassficationname}}</td>
                                    <td><b>Steplist Name :</b></td>
                                    <td>{{$stepname->stepname}}</td>

                                </tr>
                                <tr>
                                    <td><b>Period End : </b></td>
                                    <td style="color: cornflowerblue;">{{ $auditChecklistDatas->periodend }}</td>
                                    <td><b>Status :</b></td>
                                    <td> 
                                        @php
                                        $status = App\Models\Checklistanswer::
                                    leftJoin('statuses',function ($join)
                                    {$join->on('checklistanswers.status','statuses.id'); })
                                    ->where('steplist_id',$stepname->id)
                                    ->where('financialstatemantclassfication_id',$financialname->id)
                                    ->where('subclassfied_id',$subclassficationname->id)
                                    ->where('assignment_id',$assignmentbudget->assignmentgenerate_id)->select('statuses.*')->orderBy('id', 'asc')->first();
                             $count = App\Models\Checklistanswer::
                                    leftJoin('statuses',function ($join)
                                    {$join->on('checklistanswers.status','statuses.id'); })
                                    ->where('steplist_id',$stepname->id)
                                    ->where('financialstatemantclassfication_id',$financialname->id)
                                    ->where('subclassfied_id',$subclassficationname->id)
                                    ->where('assignment_id',$assignmentbudget->assignmentgenerate_id)->select('statuses.*')->get();
                                    $countauditanswer = count($count);
                                    @endphp
                                    @if( $countauditanswer == $countauditquestion)
                                    @if($status)
                                          <span class="{{ $status->color ??'' }}">{{ $status->name ??''}}</span>
                                          @else
                                          <span class="badge badge-primary">OPEN</span>
                                          @endif
                                         @else
                                          <span class="badge badge-primary">OPEN</span>   @endif
                                    </td>

                                </tr>
                                 
                               
                            </tbody>
                        </table>
                    </fieldset>
                <div class="row row-sm">
                  
              
                <div class="table-responsive">
                    <table class="table display table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="font-weight-600">Sr No.</th>
                                <th class="font-weight-600">Audit Procedure</th>
                                <th class="font-weight-600">Status</th>
                                <th class="font-weight-600">Update by</th>
                                  <th class="font-weight-600">Critical Notes</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($auditprocedure as $sub => $value)
                            <tr>
                                <td> {{ $sub+1}}</td>
                                <td> <a href="{{url('/auditchecklistanswer?'.'auditid='.$value->id.'&&'.'assignmentid='.$assignmentbudget->assignmentgenerate_id)}}"  >{{$value->auditprocedure }}</a></td>
                                
                               
 
                                <td>
                                    @forelse(App\Models\Checklistanswer::
                                    leftJoin('statuses',function ($join)
                        {$join->on('checklistanswers.status','statuses.id'); })
                                    ->where('audit_id',$value->id)
        ->where('assignment_id',$assignmentbudget->assignmentgenerate_id)->get() as $status )
                                     <span class="{{$status->color}}">{{ $status->name }}</span>
                                        <span><i class="typcn typcn-media-record text-success"></i></span>
                                    @empty
                                    <span class="badge badge-primary">OPEN</span>
                                    @endforelse
                                </td>
                                <td>  {{ DB::table('audittrails')
                                            ->leftjoin('checklistanswers','checklistanswers.id','audittrails.auditanswer_id')
                                            ->leftjoin('teammembers','teammembers.id','audittrails.created_by')
                                            ->where('checklistanswers.assignment_id', $assignmentbudget->assignmentgenerate_id)->
                                            where('checklistanswers.audit_id', $value->id)->
                                            select('teammembers.team_member','audittrails.id'
                                            )->orderBy('id', 'DESC')->pluck('teammembers.team_member')->first() ??''}}
                                            </td>
                                      @php
$critical = App\Models\Criticalnote::where('assignmentgenerateid',$assignmentbudget->assignmentgenerate_id)->
                                    where('auditquestionid',$value->id)->first();
                                @endphp
                                    @if($critical == NUll)
                                <td> </td>
                                @else
                                <td>  <a href="{{url('/criticalnotes?'.'auditid='.$value->id.'&&'.'assignmentid='.$assignmentbudget->assignmentgenerate_id)}}"   class="btn btn-success-soft btn-sm mr-1"><i class="far fa-eye"></i></a></td>
                                @endif
                            </tr>
                          @endforeach
                        </tbody>
                        
                    </table>
                
                </div>

                </div>
                {{-- <div class="row row-sm">
                    <div class="col-12">
                        <div class="form-group">
                           <textarea id="summernote" rows="14" name="c_address" value="" class="form-control"
                                placeholder="Enter Communication Address"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-8">
                        <div class="form-group">
                            <label class="font-weight-600"><b>Checklist Notice :</b></label>
                           <textarea  rows="4" name="c_address" value="" class="form-control"
                               ></textarea>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <br>
                            <label class="font-weight-600"><b>Refrence Document :</b></label>
                            
                            <span><input type="file" name="file"  value="" ></span>
                        </div>
                        <div class="form-group">
                          
                            <label class="font-weight-600"><b>Partner :</b></label>
                            
                            <span>Prashant</span>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
</div>
<!--/.body content-->

@endsection

