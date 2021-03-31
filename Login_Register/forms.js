                        function check(form){
                        if (form.product_name.value==="" && form.qty.value==="" && form.price.value ==="" && form.price.value=="" && form.cost.value===""){
                            alert("You have a BIIIIG Problem");
                            return false;
                        }
                        else if (form.product_name.value===""){
                            $("#product_name").addClass("border");
                            return false;

                        }
                        else if (form.qty.value===""){
                            $("#qty").addClass("border");
                            return false;

                        }
                        else if (form.price.value===""){
                            $("#price").addClass("border");
                            return false;

                        }
                        else if (form.cost.value===""){
                            $("#cost").addClass("border");
                            return false;

                        }
                              
                              return true;
                              
                          }