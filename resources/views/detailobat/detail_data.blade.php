<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Waktu</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Stok</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php $i = ($history->perPage() * ($history->currentPage() - 1)) + 1 ?>
        @foreach($history as $row)
        <tr>
            <th scope="row"><span <?php echo ($row->stokobat < 0) ? "class='text-danger'" : "" ?>><?= $i++; ?></span></th>
            <td><span <?php echo ($row->stokobat < 0) ? "class='text-danger'" : "" ?>>{{$row->updated_at->format('d/m/Y')}}</span></td>
            <td><span <?php echo ($row->stokobat < 0) ? "class='text-danger'" : "" ?>>{{$row->updated_at->format('H:i:s')}}</span></td>
            <td><span <?php echo ($row->stokobat < 0) ? "class='text-danger'" : "" ?>>{{$row->keterangan}}</span></td>
            <td><span <?php echo ($row->stokobat < 0) ? "class='text-danger'" : "" ?>>{{$row->stokobat}}</span></td>
            <td>
                <a href="{{($row->stokobat < 0) ? url('edit_stok/'.$row->id.'/kurang') : url('edit_stok/'.$row->id.'/tambah')}}" class="btn btn-primary fs-2 my-1">Edit</a>
                <a href="{{url('delete_stok/konfirmasi/'.$row->id)}}" class="btn btn-danger fs-2 my-1">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$history->links()}}