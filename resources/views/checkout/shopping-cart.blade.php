@extends('layouts.app')

@section('content')

    <div class="app--wrapper">
        <el-card>

            <h2>Shopping cart</h2>


            <table>
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
                </thead>

                <tbody>

		        <?php foreach(Cart::content() as $row) :?>

                <tr>
                    <td>
                        <p><strong><?php echo $row->name; ?></strong></p>
                        <p><?php echo ($row->options->has('size') ? $row->options->size : ''); ?></p>
                    </td>
                    <td><input type="text" value="<?php echo $row->qty; ?>"></td>
                    <td>$<?php echo $row->price; ?></td>
                    <td>$<?php echo $row->total; ?></td>
                </tr>

		        <?php endforeach;?>

                </tbody>

                <tfoot>
                <tr>
                    <td colspan="2">&nbsp;</td>
                    <td>Subtotal</td>
                    <td><?php echo Cart::subtotal(); ?></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                    <td>Tax</td>
                    <td><?php echo Cart::tax(); ?></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                    <td>Total</td>
                    <td><?php echo Cart::total(); ?></td>
                </tr>
                </tfoot>
            </table>

            @if(isset($artworks))
                @foreach($artworks as $artwork)
                    <el-row :gutter="20" style="margin-bottom:20px;">

                        <el-col :sm="10">
                            <img src="/imagecache/height-100{{ $artwork['item']->image_url }}" alt="" style="height: 100px;">
                        </el-col>

                        <el-col :sm="12">
                            <p>{{ $artwork['item']['title'] }}</p>
                            <p>{{ $artwork['item']->user->name }}</p>
                            @if($artwork['item']->user->country)
                                <p>{{ $artwork['item']->user->country->name }}</p>
                            @endif
                        </el-col>
                        <el-col :sm="2">
                            {{ $artwork['item']['price'] }}
                            <el-button type="text">
                                <a href="{{ route('remove-from-cart', $artwork['item']['id']) }}"><span
                                            class="el-icon-delete"></span></a>
                            </el-button>
                        </el-col>
                    </el-row>

                @endforeach


                <hr>

                <el-row :gutter="20">
                    <el-col :span="22">
                        Subtotal
                    </el-col>
                    <el-col :span="2">
                        {{ $totalPrice }}
                    </el-col>
                </el-row>

                <hr>

                <el-button type="success"><a href="{{ route('checkout') }}">Checkout</a></el-button>


            @else

                <p>
                    No items here
                </p>

            @endif

            <el-button><a href="{{ route('artworks') }}">Continue shopping</a></el-button>

        </el-card>
    </div>

@stop