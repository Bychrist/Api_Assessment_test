<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function testCreate()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }


    public function ListOfBooks()
    {
        $nullResponse = '{"status_code": 200,"status": "success","data": [] }';
        $badRequest = '{"status_code": 400,"status": "failure","data": [] }';

            
        try 
        {

            $receivedResponse = Curl::to('https://www.anapioficeandfire.com/api/books')->get();
            $data = json_decode($receivedResponse, true);
            return empty($data) ? $nullResponse : $data->assertStatus(200);

        } 
        catch (\Throwable $th)
        {
            
            return  $badRequest ;
        }
    

        
    }


    public function GetSpecificBook($no)
    {
        $nullResponse = '{"status_code": 200,"status": "success","data": [] }';
        $badRequest = '{"status_code": 400,"status": "failure","data": [] }';

            
        try 
        {

            $receivedResponse = Curl::to('https://www.anapioficeandfire.com/api/books/'. $no .'')->get();
            $data = json_decode($receivedResponse, true);
            return empty($data) ? $nullResponse : $data->assertStatus(200);

        } 
        catch (\Throwable $th)
        {
                
            return  $badRequest ;
        }
       

        
    }


    public function CreateBook(Request $request)
    {
        $successResponse = '{"status_code": 200,"status": "success"}';
        $failureResponse = '{"status_code": 400,"status": "failure"}';
        $this->validate($request, [
            "name" => "required",
            "isbn" => "required",
            "country" => "required",
            "number_of_pages" => "required",
            "publisher" => "required",
            "authors" => "required",
            "release_date" => "required",
        ]);

        try
        {

      
            $book = new Book();
            $book->name = $request->name;
            $book->isbn = $request->isbn;
            $book->country = $request->country;
            $book->number_of_pages = $request->number_of_pages;
            $book->publisher = $request->publisher;
            $book->authors = explode(',', ($request->authors));
            $book->release_date = $request->release_date;
            $book->save();
            if($book->save())
            {
                return $book->assertStatus(200);
            }
            else
            {
                return   $failureResponse;
            }

        

        } 
        catch (\Throwable $th)
        {
           return $th->getMessage();
        }

        

    }


    public function ListBooks()
    {
        $nullResponse = '{"status_code": 200,"status": "success","data": [] }';
        $bookModel = Book::all();
        $books = BookResource::collection(Book::all());
        $data = Json_decode($bookModel, true);//used to check if null value is returned
        return empty($data) ? $nullResponse : $books->assertStatus(200);
    }



    public function UpdateBook(Request $request, $id)
    {
        $successResponse = '{"status_code": 200,"status": "success"}';
        $failureResponse = '{"status_code": 400,"status": "failure"}';
        $this->validate($request, [
            "name" => "required",
            "isbn" => "required",
            "country" => "required",
            "number_of_pages" => "required",
            "publisher" => "required",
            "authors" => "required",
            "release_date" => "required",
        ]);

        try
        {

          
            $book = Book::findOrFail($id);
            $book->name = $request->name;
            $book->isbn = $request->isbn;
            $book->country = $request->country;
            $book->number_of_pages = $request->number_of_pages;
            $book->publisher = $request->publisher;
            $book->authors = explode(',', ($request->authors));
            $book->release_date = $request->release_date;
            $book->save();
            if($book->save())
            {
                return $book->assertStatus(200);
            }
            else
            {
                return   $failureResponse;
            }
        }

        catch (\Throwable $th)
        {
           return $th->getMessage();
        }





    }

    public function ShowBook($id)
    {
        try {
            
            $book = Book::findOrFail($id);
            return  BookResource($book)->assertStatus(200);

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }



    public function DeleteBook($id)
    {
        $successResponse = '{"status_code": 200,"status": "success"}';
        try {
            $book = Book::findOrFail($id);
            $book->delete();
            return $successResponse->assertStatus(200);

        } catch (\Throwable $th) {
              return $th->getMessage();
        }
    }




































}
