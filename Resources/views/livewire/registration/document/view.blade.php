<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title text-bold">Documents</h3>
        <button wire:click="create()" class="float-right btn btn-sm btn-primary">
            <i class="fas fa-plus-circle"></i> Add
        </button>
    </div>
    <div class="card-body">
        <div class="row">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Size</th>
                        <th>Mime</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viewBag->get('document') as $document)
                    <tr>
                        <td>{{$document->name}}</td>
                        <td>{{$document->type}}</td>
                        <td>{{$document->readableSize()}}</td>
                        <td>{{$document->mime}}</td>
                        <td>
                            <button wire:click="delete({{$document->id}})" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>