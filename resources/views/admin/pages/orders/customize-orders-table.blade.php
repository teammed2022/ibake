@foreach($orders as $key => $value)
                          <tr>
                            <td>
                              @if($value->orderStatus == 1)
                                  <a href="" type="button" style="text-decoration: none;" class="badge badge-outline-success btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $value->orderID  }}">View Request</a>
                              @elseif($value->orderStatus == 2)
                                  <button type="button" class="btn badge-outline-success">Approved</button>
                              @elseif($value->orderStatus == 3)
                                  <button type="button" class="btn badge-outline-danger">Rejected</button>
                                  @elseif($value->orderStatus == 4)
                                  <div class="badge badge-outline-warning">Pocessed</div>
                              @endif
                            </td>
                            <td>
                                @if ($value->orderStatus == 4)
                                    <!-- Common content when the condition is met -->
                                    <span>{{ $value->orderID }}</span>
                                    @else
                                        <!-- Content for the modal when the condition is not met -->
                                        <a href="#" style="text-decoration: none; color: brown; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $value->orderID }}" onmouseover="this.style.color='red'" onmouseout="this.style.color='brown'">
                                            {{ $value->orderID }}
                                        </a>
                                    @endif


                            </td>
                            <td>
                                {{ $value->created_at ? \Carbon\Carbon::parse($value->created_at)->format('d M Y') : '-' }}
                            </td>
                            <td>date needed</td>
                            <td>{{ $value->user->firstname }} {{ $value->user->lastname }}</td>
                            <td>{{ $value->user->phone }}</td>
                            <td>
                                @if (!empty($value->cakeOrderImage))
                                    <a href="{{ asset($value->cakeOrderImage) }}" target="_blank" class="btn btn-secondary">
                                        <i class="fas fa-eye"></i> View Image
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <textarea readonly style="width: 175px; height: 35px; overflow: auto;">{{ $value->cakeMessage  }}</textarea>
                            </td>
                            <td>
                                @if (!empty($value->cakePrice) && !is_null($value->cakePrice))
                                    &#8369; {{ number_format($value->cakePrice, 2) }}
                                @else
                                    -
                                @endif
                            </td>
                          </tr>
                          <!-- Modal -->
                          <div class="modal fade" id="staticBackdrop{{ $value->orderID  }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Order No. {{ $value->orderID  }}</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  @if($value->isSelectionOrder == 2)
                                    <div align="center">
                                      <img src="{{ asset($value->cakeOrderImage) }}" style="max-width: auto;max-height: 250px;">
                                    </div>
                                  @endif
                                  <!-- details -->
                                  @if($value->isSelectionOrder == 1)
                                    <div class="card">
                                      <div class="card-body">
                                        <label>Size:</label>
                                          <span><i>{{ $value->cakeSize }}</i></span><br>
                                        <label>Flavor:</label>
                                          <span><i>{{ $value->cakeFlavor }}</i></span><br>
                                        <label>Filling:</label>
                                          <span><i>{{ $value->cakeFilling }}</i></span><br>
                                        <label>Icing:</label>
                                          <span><i>{{ $value->cakeIcing }}</i></span><br>
                                        <label>Top Border:</label>
                                          <span><i>{{ $value->cakeTopBorder }}</i></span><br>
                                        <label>Bottom Border:</label>
                                          <span><i>{{ $value->cakeBottomBorder }}</i></span><br>
                                        <label>Decoration:</label>
                                          <span><i>{{ $value->cakeDecoration }}</i></span><br>
                                        <label>Cake Message:</label>
                                          <span><i>{{ $value->cakeMessage }}</i></span><br>
                                        <hr>
                                        <div align="right">
                                          <span>&#8369; {{ number_format($value->cakePrice, 2) }}</span>
                                        </div>
                                      </div>
                                    </div>
                                  @endif
                                  @if($value->isSelectionOrder == 2)
                                  <hr>
                                    <label>Additional Info.</label>
                                    <textarea class="form-control" rows="10" spellcheck="false" style="color:black;" readonly>{{ $value->cakeMessage  }}</textarea>
                                  <hr>
                                  @endif
                                  <form action="{{ route('processOrder', ['id' => $value->orderID]) }}" method="post"> 
                                      @csrf
                                      <input type="hidden" value="{{ $value->isSelectionOrder }}" name="isSelectionOrder">
                                      
                                      @if($value->isSelectionOrder == 2)
                                      <label>Enter Details/Remarks</label>
                                      <textarea class="form-control" name="invoice_details" rows="10" spellcheck="false" required></textarea><br>
                                      <label>Enter Price (Enter 0 for rejected order)</label>
                                      <input type="number" class="form-control" name="cakePrice" required>
                                      @endif
                                      
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn badge-outline-success approve-button" name="action" value="approve">Approved</button>
                                          <button type="submit" class="btn badge-outline-danger cancel-button" name="action" value="reject">Reject</button>
                                      </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                        