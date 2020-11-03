@extends('admin.master')

@section('title')
    Trash
@endsection

@section('content')

    <link href="{{URL::to('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary" style="float:left;">Trash Data</h5>
            <a href="/admin/trash/restore-all" class="btn btn-primary btn-icon-split" style="float:right;">
                <span class="text">Restore All</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Release Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Release Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        <?php
                            $i = 0;

                            foreach($movie as $m){
                                $i++
                        ?>
                        
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $m->title }}</td>
                                <td id="desc" style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:300px;">{{ $m->description }}</td>
                                <td>{{ date('l, d F Y', strtotime($m->release_date)) }}</td>
                                <td>
                                    <a href="/admin/trash/restore/{{ $m->id }}" class="btn btn-primary btn-sm">
                                        Restore
                                    </a>
                                    <a class="btn btn-danger btn-sm" id="btn-delete" style="color:white" data-toggle="modal" data-target="#deleteModal" data-news-id="{{ $m->id }}" onclick="handleDelete(`{{ URL::to('/admin/trash/delete/'.$m->id) }}`)">
                                        Delete
                                    </a>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this data?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Delete" below if you are ready to delete this data.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a id="link-delete">
                        <button class="btn btn-primary" type="submit">delete</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        } );

        function handleDelete(url){
            $('#link-delete').attr('href', url)
        }
    </script>

@endsection