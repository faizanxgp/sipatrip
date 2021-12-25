<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('test2', 'normalizeSimpleXML', 'XML2JSON');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function getHotels()
    {


        return view('hotels', []);
    }

    public function postHotelsSearch(Request $request)
    {
        //dump($request);

        $destination = $request['destination'];
        $fromdate = $request['fromdate'];
        $uptodate = $request['uptodate'];
        $adults = $request['adults'];
        $children = $request['children'];


        $curl = curl_init();

        $xml_data = '<SearchRequest>
  <LoginDetails>
    <Login>SipparTrip</Login>
    <Password>xmltest</Password>
    <CurrencyID>2</CurrencyID>
    <Locale>EN</Locale>
    <AgentReference></AgentReference>
  </LoginDetails>
  <SearchDetails>
    <ArrivalDate>' . $fromdate . '</ArrivalDate>
    <Duration>7</Duration>
    <RegionID>'.$destination.'</RegionID>
    <MealBasisID>0</MealBasisID>
    <MinStarRating>0</MinStarRating>
    <ContractSpecialOfferID>0</ContractSpecialOfferID>
    <RoomRequests>
      <RoomRequest>
        <Adults>' . $adults . '</Adults>
        <Children>' . $children . '</Children>
        <Infants>0</Infants>
      </RoomRequest>
    </RoomRequests>
  </SearchDetails>
</SearchRequest>';

        //echo $xml_data;

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://xmlintegrations.jactravel.com/xml/book.aspx",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "Data=" . urlencode($xml_data),

            CURLOPT_HTTPHEADER => array(
                "authorization: Basic U2lwcGFyVHJpcDp4bWx0ZXN0",
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded",
                "postman-token: 41f08e70-4c5e-bd55-9b44-61207eb8af72"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {

            $fileContents = str_replace(array("\n", "\r", "\t"), '', $response);
            $fileContents = trim(str_replace('"', "'", $fileContents));

            $simpleXml = simplexml_load_string($fileContents);

            //dump($this::XML2JSON($simpleXml));


            //dump($simpleXml);

            $properties = $simpleXml->PropertyResults;

            //$json = stripslashes(json_encode($simpleXml));

            //dump($json);

            dump($properties);

            return view('hotels', ['properties' => $properties]);

        }

        return true;

    }


    public function getHotelDetails($id) {


        $curl = curl_init();

        $xml_data = '<PropertyDetailsRequest>
  <LoginDetails>
	<Login>SipparTrip</Login>
	<Password>xmltest</Password>
	<CurrencyID>2</CurrencyID>
	<Locale>EN</Locale>
	<AgentReference></AgentReference>
  </LoginDetails>
  <PropertyID>'. $id .'</PropertyID>
</PropertyDetailsRequest>';

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://xmlintegrations.jactravel.com/xml/book.aspx",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "Data=" . urlencode($xml_data),

            CURLOPT_HTTPHEADER => array(
                "authorization: Basic U2lwcGFyVHJpcDp4bWx0ZXN0",
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded",
                "postman-token: 41f08e70-4c5e-bd55-9b44-61207eb8af72"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {

            //$fileContents = str_replace(array("\n", "\r", "\t"), '', $response);
            $fileContents = trim(str_replace('"', "'", $response));

            $simpleXml = simplexml_load_string($fileContents);

            //dump($this::XML2JSON($simpleXml));


            //dump($simpleXml);




            //dump($simpleXml);

            $property = $simpleXml;

            //$json = stripslashes(json_encode($simpleXml));

            //dump($json);

            dump($property);

            return view('hotel-details', ['property' => $property]);



        }
    }

    public function test()
    {

        $xml = '
<?xml version="1.0" encoding="UTF-8"?>
<SearchResponse>
<ReturnStatus>
<Success>true</Success>
<Exception />
</ReturnStatus>
<SearchURL />
<CurrencyID>2</CurrencyID>
<PropertyResults>
<PropertyResult>
<TotalProperties>22</TotalProperties>
<PropertyID>2394</PropertyID>
<PropertyReferenceID>68767</PropertyReferenceID>
<PropertyName>Thon Brussels City Centre</PropertyName>
<Rating>4.0</Rating>
<OurRating>4.0</OurRating>
<Country>Belgium</Country>
<Region>Brussels</Region>
<Resort>Brussels City Centre</Resort>
<SearchURL />
<RoomTypes>
<RoomType>
<Seq>1</Seq>
<PropertyRoomTypeID>15329</PropertyRoomTypeID>
<MealBasisID>1</MealBasisID>
<RoomType>Room Only Twin</RoomType>
<RoomView />
<MealBasis>Room only</MealBasis>
<SubTotal>114.40</SubTotal>
<Discount>0.00</Discount>
<OnRequest>false</OnRequest>
<Total>114.40</Total>
<Adults>2</Adults>
<Children>1</Children>
<Infants>0</Infants>
<Adjustments />
<Errata />
<OptionalSupplements />
</RoomType>
<RoomType>
<Seq>1</Seq>
<PropertyRoomTypeID>15328</PropertyRoomTypeID>
<MealBasisID>1</MealBasisID>
<RoomType>Room Only Double</RoomType>
<RoomView />
<MealBasis>Room only</MealBasis>
<SubTotal>114.40</SubTotal>
<Discount>0.00</Discount>
<OnRequest>false</OnRequest>
<Total>114.40</Total>
<Adults>2</Adults>
<Children>1</Children>
<Infants>0</Infants>
<Adjustments />
<Errata />
<OptionalSupplements />
</RoomType>
<RoomType>
<Seq>1</Seq>
<PropertyRoomTypeID>15317</PropertyRoomTypeID>
<MealBasisID>3</MealBasisID>
<RoomType>Twin</RoomType>
<RoomView />
<MealBasis>Breakfast</MealBasis>
<SubTotal>238.33</SubTotal>
<Discount>0.00</Discount>
<OnRequest>false</OnRequest>
<Total>238.33</Total>
<Adults>2</Adults>
<Children>1</Children>
<Infants>0</Infants>
<Adjustments />
<Errata />
<OptionalSupplements />
</RoomType>
<RoomType>
<Seq>1</Seq>
<PropertyRoomTypeID>15316</PropertyRoomTypeID>
<MealBasisID>3</MealBasisID>
<RoomType>Double</RoomType>
<RoomView />
<MealBasis>Breakfast</MealBasis>
<SubTotal>238.33</SubTotal>
<Discount>0.00</Discount>
<OnRequest>false</OnRequest>
<Total>238.33</Total>
<Adults>2</Adults>
<Children>1</Children>
<Infants>0</Infants>
<Adjustments />
<Errata />
<OptionalSupplements />
</RoomType>
<RoomType>
<Seq>1</Seq>
<PropertyRoomTypeID>15318</PropertyRoomTypeID>
<MealBasisID>3</MealBasisID>
<RoomType>Triple</RoomType>
<RoomView />
<MealBasis>Breakfast</MealBasis>
<SubTotal>381.34</SubTotal>
<Discount>0.00</Discount>
<OnRequest>false</OnRequest>
<Total>381.34</Total>
<Adults>3</Adults>
<Children>0</Children>
<Infants>0</Infants>
<Adjustments />
<Errata />
<OptionalSupplements />
</RoomType>
</RoomTypes>
</PropertyResult>
<PropertyResult>
<TotalProperties>22</TotalProperties>
<PropertyID>2059</PropertyID>
<PropertyReferenceID>68770</PropertyReferenceID>
<PropertyName>Van Belle</PropertyName>
<Rating>3.0</Rating>
<OurRating>3.0</OurRating>
<Country>Belgium</Country>
<Region>Brussels</Region>
<Resort>Brussels City Centre</Resort>
<SearchURL />
<RoomTypes>
<RoomType>
<Seq>1</Seq>
<PropertyRoomTypeID>12334</PropertyRoomTypeID>
<MealBasisID>8</MealBasisID>
<RoomType>Triple</RoomType>
<RoomView />
<MealBasis>Buffet breakfast</MealBasis>
<SubTotal>190.66</SubTotal>
<Discount>0.00</Discount>
<OnRequest>false</OnRequest>
<Total>190.66</Total>
<Adults>3</Adults>
<Children>0</Children>
<Infants>0</Infants>
<Adjustments />
<Errata />
<OptionalSupplements />
</RoomType>
</RoomTypes>
</PropertyResult>
<PropertyResult>
<TotalProperties>22</TotalProperties>
<PropertyID>2324</PropertyID>
<PropertyReferenceID>68734</PropertyReferenceID>
<PropertyName>Best Western Carrefour De L\'Europe</PropertyName>
      <Rating>4.0</Rating>
      <OurRating>4.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Brussels City Centre</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>18889</PropertyRoomTypeID>
          <MealBasisID>130</MealBasisID>
          <RoomType>Business Class Triple</RoomType>
          <RoomView />
          <MealBasis>American breakfast</MealBasis>
          <SubTotal>190.66</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>190.66</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>1757</PropertyID>
      <PropertyReferenceID>68779</PropertyReferenceID>
      <PropertyName>La Madeleine Hotel</PropertyName>
      <Rating>2.0</Rating>
      <OurRating>2.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Brussels City Centre</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>10520</PropertyRoomTypeID>
          <MealBasisID>129</MealBasisID>
          <RoomType>Double (Same Bedding as parents)</RoomType>
          <RoomView />
          <MealBasis>Cold buffet breakfast</MealBasis>
          <SubTotal>238.33</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>238.33</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>10521</PropertyRoomTypeID>
          <MealBasisID>129</MealBasisID>
          <RoomType>Twin (Same Bedding as parents)</RoomType>
          <RoomView />
          <MealBasis>Cold buffet breakfast</MealBasis>
          <SubTotal>286.01</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>286.01</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>10522</PropertyRoomTypeID>
          <MealBasisID>129</MealBasisID>
          <RoomType>Triple</RoomType>
          <RoomView />
          <MealBasis>Cold buffet breakfast</MealBasis>
          <SubTotal>333.67</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>333.67</Total>
          <Adults>3</Adults>
          <Children>0</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>1630</PropertyID>
      <PropertyReferenceID>68831</PropertyReferenceID>
      <PropertyName>Floris Louise</PropertyName>
      <Rating>4.0</Rating>
      <OurRating>4.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Elsene</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>19199</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Twin (non-refundable) (Extra bed)</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>286.01</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>286.01</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>19198</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Double (non-refundable) (Extra bed)</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>286.01</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>286.01</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>3143</PropertyID>
      <PropertyReferenceID>68851</PropertyReferenceID>
      <PropertyName>Leopold Hotel Brussels</PropertyName>
      <Rating>4.0</Rating>
      <OurRating>4.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>European Quarter</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21618</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Twin</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>286.01</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>286.01</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21617</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Double (Same Bedding as parents)</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>286.01</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>286.01</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21619</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Triple</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>476.67</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>476.67</Total>
          <Adults>3</Adults>
          <Children>0</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>3165</PropertyID>
      <PropertyReferenceID>86464</PropertyReferenceID>
      <PropertyName>Ramada Brussels Woluwe</PropertyName>
      <Rating>4.0</Rating>
      <OurRating>4.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Brussels vicinity</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21898</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Twin</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>286.01</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>286.01</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21897</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Double</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>286.01</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>286.01</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21901</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Triple</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>476.67</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>476.67</Total>
          <Adults>3</Adults>
          <Children>0</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>3140</PropertyID>
      <PropertyReferenceID>68834</PropertyReferenceID>
      <PropertyName>Izan Avenue Louise Hotel</PropertyName>
      <Rating>4.0</Rating>
      <OurRating>4.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Elsene</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21907</PropertyRoomTypeID>
          <MealBasisID>130</MealBasisID>
          <RoomType>Room Only Twin (Extra bed)</RoomType>
          <RoomView />
          <MealBasis>American breakfast</MealBasis>
          <SubTotal>333.67</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>333.67</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21907</PropertyRoomTypeID>
          <MealBasisID>1</MealBasisID>
          <RoomType>Room Only Twin (Extra bed)</RoomType>
          <RoomView />
          <MealBasis>Room only</MealBasis>
          <SubTotal>333.67</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>333.67</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21604</PropertyRoomTypeID>
          <MealBasisID>1</MealBasisID>
          <RoomType>Twin (Extra bed)</RoomType>
          <RoomView />
          <MealBasis>Room only</MealBasis>
          <SubTotal>381.34</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>381.34</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21604</PropertyRoomTypeID>
          <MealBasisID>130</MealBasisID>
          <RoomType>Twin (Extra bed)</RoomType>
          <RoomView />
          <MealBasis>American breakfast</MealBasis>
          <SubTotal>381.34</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>381.34</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21603</PropertyRoomTypeID>
          <MealBasisID>1</MealBasisID>
          <RoomType>Double (Extra bed)</RoomType>
          <RoomView />
          <MealBasis>Room only</MealBasis>
          <SubTotal>381.34</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>381.34</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21603</PropertyRoomTypeID>
          <MealBasisID>130</MealBasisID>
          <RoomType>Double (Extra bed)</RoomType>
          <RoomView />
          <MealBasis>American breakfast</MealBasis>
          <SubTotal>381.34</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>381.34</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21908</PropertyRoomTypeID>
          <MealBasisID>130</MealBasisID>
          <RoomType>Room Only Triple</RoomType>
          <RoomView />
          <MealBasis>American breakfast</MealBasis>
          <SubTotal>429.01</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>429.01</Total>
          <Adults>3</Adults>
          <Children>0</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21908</PropertyRoomTypeID>
          <MealBasisID>1</MealBasisID>
          <RoomType>Room Only Triple</RoomType>
          <RoomView />
          <MealBasis>Room only</MealBasis>
          <SubTotal>429.01</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>429.01</Total>
          <Adults>3</Adults>
          <Children>0</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21605</PropertyRoomTypeID>
          <MealBasisID>130</MealBasisID>
          <RoomType>Triple</RoomType>
          <RoomView />
          <MealBasis>American breakfast</MealBasis>
          <SubTotal>476.67</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>476.67</Total>
          <Adults>3</Adults>
          <Children>0</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21605</PropertyRoomTypeID>
          <MealBasisID>1</MealBasisID>
          <RoomType>Triple</RoomType>
          <RoomView />
          <MealBasis>Room only</MealBasis>
          <SubTotal>476.67</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>476.67</Total>
          <Adults>3</Adults>
          <Children>0</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>1628</PropertyID>
      <PropertyReferenceID>77582</PropertyReferenceID>
      <PropertyName>Floris Arlequin Grand Place</PropertyName>
      <Rating>3.0</Rating>
      <OurRating>3.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Brussels City Centre</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>9748</PropertyRoomTypeID>
          <MealBasisID>9</MealBasisID>
          <RoomType>Triple</RoomType>
          <RoomView />
          <MealBasis>Hot buffet breakfast</MealBasis>
          <SubTotal>476.67</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>476.67</Total>
          <Adults>3</Adults>
          <Children>0</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>9747</PropertyRoomTypeID>
          <MealBasisID>9</MealBasisID>
          <RoomType>Twin</RoomType>
          <RoomView />
          <MealBasis>Hot buffet breakfast</MealBasis>
          <SubTotal>667.33</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>667.33</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>9746</PropertyRoomTypeID>
          <MealBasisID>9</MealBasisID>
          <RoomType>Double</RoomType>
          <RoomView />
          <MealBasis>Hot buffet breakfast</MealBasis>
          <SubTotal>667.33</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>667.33</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>23652</PropertyRoomTypeID>
          <MealBasisID>3</MealBasisID>
          <RoomType>Promo Double (Extra bed)</RoomType>
          <RoomView />
          <MealBasis>Breakfast</MealBasis>
          <SubTotal>2192.68</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>2192.68</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>3535</PropertyID>
      <PropertyReferenceID>151826</PropertyReferenceID>
      <PropertyName>Test Hotel Brussels</PropertyName>
      <Rating>4.0</Rating>
      <OurRating>4.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Brussels Airport</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>24704</PropertyRoomTypeID>
          <MealBasisID>2</MealBasisID>
          <RoomType>Club Quad</RoomType>
          <RoomView>Corner View</RoomView>
          <MealBasis>All inclusive</MealBasis>
          <SubTotal>572.00</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>572.00</Total>
          <Adults>3</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>3167</PropertyID>
      <PropertyReferenceID>68868</PropertyReferenceID>
      <PropertyName>Best Western City Centre</PropertyName>
      <Rating>3.0</Rating>
      <OurRating>3.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Sint-Joost-Ten-Node</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21920</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Twin</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>715.00</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>715.00</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21919</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Double</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>715.00</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>715.00</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>21921</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Triple</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>810.33</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>810.33</Total>
          <Adults>3</Adults>
          <Children>0</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>2396</PropertyID>
      <PropertyReferenceID>77607</PropertyReferenceID>
      <PropertyName>Thon Brussels Airport</PropertyName>
      <Rating>3.0</Rating>
      <OurRating>3.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Brussels Airport</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>15338</PropertyRoomTypeID>
          <MealBasisID>1</MealBasisID>
          <RoomType>Room Only Twin</RoomType>
          <RoomView />
          <MealBasis>Room only</MealBasis>
          <SubTotal>762.66</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>762.66</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>15337</PropertyRoomTypeID>
          <MealBasisID>1</MealBasisID>
          <RoomType>Room Only Double</RoomType>
          <RoomView />
          <MealBasis>Room only</MealBasis>
          <SubTotal>762.66</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>762.66</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>3539</PropertyID>
      <PropertyReferenceID>151827</PropertyReferenceID>
      <PropertyName>Brussles Certification Test Hotel</PropertyName>
      <Rating>1.0</Rating>
      <OurRating>1.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Brussels City Centre</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>24714</PropertyRoomTypeID>
          <MealBasisID>3</MealBasisID>
          <RoomType>Deluxe Quad</RoomType>
          <RoomView>Corner View</RoomView>
          <MealBasis>Breakfast</MealBasis>
          <SubTotal>953.34</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>953.34</Total>
          <Adults>3</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>1365321</PropertyID>
      <PropertyReferenceID>68840</PropertyReferenceID>
      <PropertyName>Warwick Barsey</PropertyName>
      <Rating>4.0</Rating>
      <OurRating>4.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Elsene</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>0</PropertyRoomTypeID>
          <BookingToken>n9+jGnj2r5z8ZObOOzu3GvwAJYKu3enR/uiAXmOVeFr/lEYRVSWygtj4G0x/WGFkp923o9jIorijtwHudi3YWVbUfxD3ORTvs9gfCAfMPxvad3TcfZEJQA==</BookingToken>
          <MealBasisID>3</MealBasisID>
          <RoomType>Twin/double Room</RoomType>
          <RoomView />
          <MealBasis>Breakfast</MealBasis>
          <SubTotal>1286.34</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>1286.34</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>0</PropertyRoomTypeID>
          <BookingToken>RwKPVAnw/LVfMpxuRKjfvvJQEtW3Q9kAXMlRaG45zumuEQBRUu2B6OsNU9BS+IQcf1O6NY266tvHiuce6PEcSj794mL2+dWdMMk1baAur5lvyfxYjabsXCU6/+dIYL/u</BookingToken>
          <MealBasisID>3</MealBasisID>
          <RoomType>Twin/double Room - Premium</RoomType>
          <RoomView />
          <MealBasis>Breakfast</MealBasis>
          <SubTotal>1531.82</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>1531.82</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>1735365</PropertyID>
      <PropertyReferenceID>85778</PropertyReferenceID>
      <PropertyName>Park Inn</PropertyName>
      <Rating>3.0</Rating>
      <OurRating>3.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Midi Station</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>0</PropertyRoomTypeID>
          <BookingToken>XlRQ6621jEDdO2/dGFBLWHw323bQrfMOLFgbcIvn5Pp5YCnFHqZWy0TDZXYgbDPFPRKUVVSLAMJzPXmFftnSup1Fek5yj121oB4KUBKsvUY=</BookingToken>
          <MealBasisID>3</MealBasisID>
          <RoomType>Triple Room</RoomType>
          <RoomView />
          <MealBasis>Breakfast</MealBasis>
          <SubTotal>1325.62</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>1325.62</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>2874</PropertyID>
      <PropertyReferenceID>68878</PropertyReferenceID>
      <PropertyName>Hilton Brussels City</PropertyName>
      <Rating>4.0</Rating>
      <OurRating>4.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Sint-Joost-Ten-Node</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>19730</PropertyRoomTypeID>
          <MealBasisID>3</MealBasisID>
          <RoomType>Triple Deluxe</RoomType>
          <RoomView />
          <MealBasis>Breakfast</MealBasis>
          <SubTotal>1906.67</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>1906.67</Total>
          <Adults>3</Adults>
          <Children>0</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>2709</PropertyID>
      <PropertyReferenceID>68749</PropertyReferenceID>
      <PropertyName>Le Plaza Brussels</PropertyName>
      <Rating>5.0</Rating>
      <OurRating>5.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Brussels City Centre</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>18326</PropertyRoomTypeID>
          <MealBasisID>1</MealBasisID>
          <RoomType>Twin Deluxe (Extra bed)</RoomType>
          <RoomView />
          <MealBasis>Room only</MealBasis>
          <SubTotal>2097.35</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>2097.35</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>18325</PropertyRoomTypeID>
          <MealBasisID>1</MealBasisID>
          <RoomType>Double Deluxe (Extra bed)</RoomType>
          <RoomView />
          <MealBasis>Room only</MealBasis>
          <SubTotal>2097.35</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>2097.35</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>18327</PropertyRoomTypeID>
          <MealBasisID>1</MealBasisID>
          <RoomType>Triple Deluxe</RoomType>
          <RoomView />
          <MealBasis>Room only</MealBasis>
          <SubTotal>2860.01</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>2860.01</Total>
          <Adults>3</Adults>
          <Children>0</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>1631</PropertyID>
      <PropertyReferenceID>68743</PropertyReferenceID>
      <PropertyName>Floris Ustel Midi</PropertyName>
      <Rating>3.0</Rating>
      <OurRating>3.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Brussels City Centre</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>9765</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Twin (Extra bed)</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>2192.68</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>2192.68</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments>
            <Adjustment>
              <AdjustmentType>Supplement</AdjustmentType>
              <SpecialOfferTypeID>0</SpecialOfferTypeID>
              <AdjustmentName>Mandatory Supplement</AdjustmentName>
              <ContractArrangementID>0</ContractArrangementID>
              <Total>286.01</Total>
            </Adjustment>
          </Adjustments>
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>9764</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Double (Extra bed)</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>2192.68</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>2192.68</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments>
            <Adjustment>
              <AdjustmentType>Supplement</AdjustmentType>
              <SpecialOfferTypeID>0</SpecialOfferTypeID>
              <AdjustmentName>Mandatory Supplement</AdjustmentName>
              <ContractArrangementID>0</ContractArrangementID>
              <Total>286.01</Total>
            </Adjustment>
          </Adjustments>
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>9766</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Triple</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>3146.02</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>3146.02</Total>
          <Adults>3</Adults>
          <Children>0</Children>
          <Infants>0</Infants>
          <Adjustments>
            <Adjustment>
              <AdjustmentType>Supplement</AdjustmentType>
              <SpecialOfferTypeID>0</SpecialOfferTypeID>
              <AdjustmentName>Mandatory Supplement</AdjustmentName>
              <ContractArrangementID>0</ContractArrangementID>
              <Total>286.01</Total>
            </Adjustment>
          </Adjustments>
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>1629</PropertyID>
      <PropertyReferenceID>68742</PropertyReferenceID>
      <PropertyName>Floris Avenue</PropertyName>
      <Rating>4.0</Rating>
      <OurRating>4.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Brussels City Centre</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>9753</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Twin (Extra bed)</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>2383.34</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>2383.34</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>9752</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Double (Extra bed)</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>2383.34</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>2383.34</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>9754</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Triple</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>2860.01</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>2860.01</Total>
          <Adults>3</Adults>
          <Children>0</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>1165138</PropertyID>
      <PropertyReferenceID>68877</PropertyReferenceID>
      <PropertyName>Des Colonies</PropertyName>
      <Rating>3.0</Rating>
      <OurRating>3.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Sint-Joost-Ten-Node</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>0</PropertyRoomTypeID>
          <BookingToken>z8LijlJZ48guiX19o+b9R4Vh8XOS1l8Vu3K/qPSJ60y91CMcWcPk7wrfoZQIJhoAzg8Uo/GN9LY7ffKowVKshIE7mG5THufS4cQOkvfWyHnxRk3UlpZa4109bCTKbuToTY1PUn4yJoX+zShW1+gvkiL2kmYjmOLb</BookingToken>
          <MealBasisID>8</MealBasisID>
          <RoomType>Standard Twin</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>2526.35</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>2526.35</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>1725830</PropertyID>
      <PropertyReferenceID>68732</PropertyReferenceID>
      <PropertyName>Amigo</PropertyName>
      <Rating>5.0</Rating>
      <OurRating>5.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>Brussels City Centre</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>0</PropertyRoomTypeID>
          <BookingToken>6ZI2kuPswCJ6DW2PPAK0ljN2jfrJtRRyPa7kB6AkwUBPgM/qPMyYVzDp4/2KgSDxNGScCNiFZIqUz9idg59bX/4pofCeJhOUrvu4FiwgQ40E86ulG38z2Fu6gfE9soKh</BookingToken>
          <MealBasisID>3</MealBasisID>
          <RoomType>Twin/double Room - De Luxe</RoomType>
          <RoomView />
          <MealBasis>Breakfast</MealBasis>
          <SubTotal>2833.60</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>2833.60</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>0</PropertyRoomTypeID>
          <BookingToken>4dCHdronf5BvANdBKvv5NpjnHtM9rzjbkKHD+TzCzPOieTY/pIUXsWxH8Wxn9RvAV7fsp9ugEABajIdIf82LkFyIEYv4OyW3HHb9TZtk4/WzfYcI0FcIL5cDjlUatT+V</BookingToken>
          <MealBasisID>3</MealBasisID>
          <RoomType>Twin/double Room - Executive</RoomType>
          <RoomView />
          <MealBasis>Breakfast</MealBasis>
          <SubTotal>3693.49</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>3693.49</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
    <PropertyResult>
      <TotalProperties>22</TotalProperties>
      <PropertyID>2123</PropertyID>
      <PropertyReferenceID>77603</PropertyReferenceID>
      <PropertyName>First Euroflat Hotel</PropertyName>
      <Rating>4.0</Rating>
      <OurRating>4.0</OurRating>
      <Country>Belgium</Country>
      <Region>Brussels</Region>
      <Resort>European Quarter</Resort>
      <SearchURL />
      <RoomTypes>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>12847</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Twin (Extra bed)</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>14300.08</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>14300.08</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
        <RoomType>
          <Seq>1</Seq>
          <PropertyRoomTypeID>12846</PropertyRoomTypeID>
          <MealBasisID>8</MealBasisID>
          <RoomType>Double (Extra bed)</RoomType>
          <RoomView />
          <MealBasis>Buffet breakfast</MealBasis>
          <SubTotal>14300.08</SubTotal>
          <Discount>0.00</Discount>
          <OnRequest>false</OnRequest>
          <Total>14300.08</Total>
          <Adults>2</Adults>
          <Children>1</Children>
          <Infants>0</Infants>
          <Adjustments />
          <Errata />
          <OptionalSupplements />
        </RoomType>
      </RoomTypes>
    </PropertyResult>
  </PropertyResults>
</SearchResponse>';


        //echo $xml;

        //$xml = str_replace(array("\n", "\r", "\t"), '', $xml);    // removes newlines, returns and tabs

        // replace double quotes with single quotes, to ensure the simple XML function can parse the XML
        //$xml = trim(str_replace('"', "'", $xml));


        //$xml = simplexml_load_string($xml_string);
        //$json = json_encode($xml);
        //print_r($json);
        //$array = json_decode($json,TRUE);
        //print_r($array);

//        $xml = str_replace(array("\n", "\r", "\t"), '', $xml);    // removes newlines, returns and tabs
//
//        // replace double quotes with single quotes, to ensure the simple XML function can parse the XML
//        $xml = trim(str_replace('"', "'", $xml));
//        $simpleXml = simplexml_load_string($xml);
//dump($simpleXml);

        //echo XMLtoJSON($xml);


        $xml2 = '<?xml version="1.0" encoding="UTF-8"?>
<websites>
  <site id="1" pr="5">
    <title>Web Programming Courses</title>
    <url>http://coursesweb.net/</url>
  </site>
  <site id="2" pr="4">
    <title>Courses Games Anime</title>
    <url>http://marplo.net/</url>
  </site>
</websites>';

        $xml = str_replace(array("\n", "\r", "\t"), '', $xml);    // removes newlines, returns and tabs

        // replace double quotes with single quotes, to ensure the simple XML function can parse the XML
        $xml = trim(str_replace('"', "'", $xml));
        $simpleXml = simplexml_load_string($xml);

        dump($simpleXml);


        //echo $simpleXml->PropertyResults->PropertyResult[0]->PropertyName;
        //echo $simpleXml->PropertyResults->PropertyResult[1]->PropertyName;
        //echo $simpleXml->PropertyResults->PropertyResult[2]->PropertyName;
        //echo $simpleXml->PropertyResults->PropertyResult[3]->PropertyName;

        $properties = $simpleXml->PropertyResults->PropertyResult;

        // dump($properties);
        foreach ($properties as $property) {
            echo $property->PropertyName;
            echo $property->Rating;
            echo $property->OurRating;
            echo $property->Country;
            echo $property->Region;
            echo $property->Resort;

            $roomtypes = $property->RoomTypes->RoomType;

            foreach ($roomtypes as $roomtype) {
                echo $roomtype->RoomType;
                echo $roomtype->PropertyRoomTypeID;
                echo '<br />';
            }

            //dump($property);
        }


//
//
//        $a = stripslashes(json_encode($simpleXml));
//dump($a);
//
//
//        $b = json_decode($a, true);
//
//        dump($b);


    }

    public function test2()
    {


        $curl = curl_init();

        $xml_data = '<SearchRequest>
  <LoginDetails>
    <Login>SipparTrip</Login>
    <Password>xmltest</Password>
    <Locale></Locale>
    <AgentReference></AgentReference>
  </LoginDetails>
  <SearchDetails>
    <ArrivalDate>2017-12-29</ArrivalDate>
    <Duration>7</Duration>
    <RegionID>72</RegionID>
    <MealBasisID>0</MealBasisID>
    <MinStarRating>0</MinStarRating>
    <ContractSpecialOfferID>0</ContractSpecialOfferID>
    <RoomRequests>
      <RoomRequest>
        <Adults>2</Adults>
        <Children>0</Children>
        <Infants>0</Infants>
      </RoomRequest>
    </RoomRequests>
  </SearchDetails>
</SearchRequest>';

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://xmlintegrations.jactravel.com/xml/book.aspx",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "Data=" . urlencode($xml_data),

            CURLOPT_HTTPHEADER => array(
                "authorization: Basic U2lwcGFyVHJpcDp4bWx0ZXN0",
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded",
                "postman-token: 41f08e70-4c5e-bd55-9b44-61207eb8af72"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {

            $fileContents = str_replace(array("\n", "\r", "\t"), '', $response);
            $fileContents = trim(str_replace('"', "'", $fileContents));

            $simpleXml = simplexml_load_string($fileContents);

            //dump($this::XML2JSON($simpleXml));


            dump($simpleXml);

            $json = stripslashes(json_encode($simpleXml));

            dump($json);


        }
    }
//
//    function normalizeSimpleXML($obj, &$result) {
//        $data = $obj;
//        if (is_object($data)) {
//            $data = get_object_vars($data);
//        }
//        if (is_array($data)) {
//            foreach ($data as $key => $value) {
//                $res = null;
//                $this::normalizeSimpleXML($value, $res);
//                if (($key == '@attributes') && ($key)) {
//                    $result = $res;
//                } else {
//                    $result[$key] = $res;
//                }
//            }
//        } else {
//            $result = $data;
//        }
//    }
//
//    function XML2JSON($xml) {
//
//
//        $result="";
//        $this::normalizeSimpleXML(simplexml_load_string($xml), $result);
//        return json_encode($result);
//    }
//
//    function XMLtoJSON($xml) {
//        $xml = str_replace(array("\n", "\r", "\t"), '', $xml);    // removes newlines, returns and tabs
//
//        // replace double quotes with single quotes, to ensure the simple XML function can parse the XML
//        $xml = trim(str_replace('"', "'", $xml));
//        $simpleXml = simplexml_load_string($xml);
//
//        return stripslashes(json_encode($simpleXml));    // returns a string with JSON object
//    }


}
