@extends('layouts.app')

@section('htmlheader_title')
	Manger User
@endsection

@section('style')
@parent
<link href="{{ asset('/css/adtablestyle.css') }}" rel="stylesheet">
@endsection

@section('main-content')
	
	
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2 class="title"> {{ trans('adtable.ad_table_style_title') }}</h2>
		</div>	
	</div>
	<div class="row">
		<div class="col-md-12">
			<h4> {{ trans('adtable.ad_table_style_col') }}</h4>
		</div>	

		<div class="col-md-2">
			<div class="default-col">
				@foreach($style as $k=>$v)
				<span>{{ trans('adtable.'.$v) }}<div>A{{ $k }}:</div></span>
				@endforeach
			</div>
		</div>
		<div class="col-md-2">
			<div class="default-col">
				@foreach($total as $v)
				<span>{{ trans('adtable.ad_table_total_'.$v) }}<div>{{ $v }}:</div></span>
				@endforeach
			</div>
		</div>
		<div class="col-md-8">
			
			<div class="table_style">
				<form name="col_table">
					<table class="form-table">
						<thead>
							<tr>
								<th>{{ trans('adtable.ad_table_style_colname') }}</th>
								<th>{{ trans('adtable.ad_table_style_colvalue') }}</th>
								<th>{{ trans('adtable.ad_table_style_coltotal') }}</th>
								<th width="160">{{ trans('adtable.ad_table_style_colsort') }}</th>
							</tr>
						</thead>
						<tbody id="style-col-body">	
						</tbody>
						<tfoot>
							<tr>
								<td colspan="4">
									<a class="help"><i class="fa fa fa-info"></i></a>
									<button onclick="return saveForm();">{{ trans('adtable.ad_table_style_save') }}</button>
									<button onclick="return colAdd();">{{ trans('adtable.ad_table_style_add') }}</button>
								</td>
							</tr>
						</tfoot>
					</table>
				</form>	
			</div>
		</div>
		
	</div>


	<div class="row">
		<div class="col-md-12">
			<div class="line1"></div>
		</div>

		<div class="col-md-2">
			<h4> {{ trans('adtable.ad_table_style_sum') }}</h4>
		</div>	
		<div class="col-md-10">

			<div class="col-md-4">
				<div class="col-md-6">
					<label style="line-height: 41px;">是否显示</label>
				</div>	
				<div class="col-md-6">
					<div class="controls">
					<label class="radio"><input type="radio" value="True" name="show" checked="checked">
					True</label>
					<label class="radio"><input type="radio" value="False" name="show">False</label>
					</div>
				</div>	
			</div>

			<div class="col-md-4">
				<div class="col-md-6">
					<label style="line-height: 41px;">显示位置</label>
				</div>	
				<div class="col-md-6">	
					<div class="controls">
					<label class="checkbox"><input type="checkbox" value="Top">Top</label>
					<label class="checkbox"><input type="checkbox" value="Bottom">Bottom</label>
					</div>
				</div>
			</div>

			<div class="col-md-4">
			<div class="control-group">
				<label class="control-label"></label>
				<div class="controls"><button class="btn btn-inverse">Sumbit</button></div>
			</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="line1"></div>
		</div>
		<div class="col-md-3">
			<h4> {{ trans('adtable.ad_table_style_account') }}</h4>
		</div>	
		<div class="col-md-9">
			show , hidden , top , bottom , left , right
		</div>			
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="line1"></div>
		</div>	
		<div class="col-md-3">
			<h4> {{ trans('adtable.ad_table_style_sort') }}</h4>
		</div>	
		<div class="col-md-9">
			asc , desc
		</div>		
	</div>	

</div>




<script type="text/template" name="style-form">  
<tr>
	<td><input name="name[]" value="{name}"></td>
	<td><input name="value[]" value="{value}"></td>
	<td><input name="total[]" value="{total}"></td>
	<td>
		<a class="up" onclick="colUpDown(this,'long-up')"><i class="fa fa-long-arrow-up" ></i></a>
		<a class="up" onclick="colUpDown(this,'up')"><i class="fa fa-arrow-up"></i></a>
		<a class="down" onclick="colUpDown(this,'down')"><i class="fa fa-arrow-down"></i></a>
		<a class="down" onclick="colUpDown(this,'long-down')"><i class="fa fa-long-arrow-down"></i></a>
		<a onclick="colDel(this)"><i class="fa fa-close"></i></a>
	</td>
</tr>
</script> 


<script type="text/javascript">



var $styleColBody = $('#style-col-body');
var styleColhtml = $('script[name=style-form]').html();

getForm();



function formatTemplate(dta, tmpl) {  
    var format = {  
        toKey : function(x){
        	if(keyJson[x] != undefined ){
        		return keyJson[x];
        	}
        	return x;
        },
        status : function(x){
        	alert(x);
        }
    };  

    return tmpl.replace(/{(.*)}/g, function(m1, m2) {  

        if(!m2) return "";  
        return dta[m2]; 

    });  
} 

function colUpDown(obj,statu = 'up'){
	var $objTr = $(obj).parents('tr');
	if(statu == 'up'){
		$prevTr = $objTr.prev();
		$objTr.insertBefore($prevTr);
	}else if(statu == 'long-up'){
		$objTr.prependTo($styleColBody);
	}else if(statu == 'down'){
		$nextTr = $objTr.next();
		$objTr.insertAfter($nextTr);
	}else if(statu == 'long-down'){
		$objTr.appendTo($styleColBody);
	}

}

function colDel(obj){
	var $objTr = $(obj).parents('tr').remove();
}

function colAdd(){
	$styleColBody.append(styleColhtml);
	return false;
}

function fillTable($data){
	var html = $('script[name="style-form"]').html();  
    var arr = [];  
    $.each($data, function(i, o) {   
        arr.push(formatTemplate(o, html));  
    });  

    $styleColBody.html(arr.join(''));

}

function getForm(){
	ajaxForm();
	return false;
}

function saveForm(){
	ajaxForm($("form[name=col_table]").serialize());
	return false;
}

function ajaxForm($data = ''){
	$('.table_style').covermask({text:loading_img});
	$.ajax({
		url: "{{ asset('/ajax/adtablestyle') }}",
		data: $data,
		type: "post",
		dataType: "json",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} ,
		success: function(d){
			if(!d  || d['e'] == 1) return false;
			fillTable(d['d'])
		},
		complete:function(){
			$('.table_style').hidemask();
		}
	});
}

</script>
	
@endsection
