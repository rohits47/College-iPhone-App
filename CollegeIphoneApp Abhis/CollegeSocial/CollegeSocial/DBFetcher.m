//
//  DBFetcher.m
//  CollegeSocial
//
//  Created by Rohit Sanbhadti on 8/3/11.
//  Copyright 2011 Harker High School. All rights reserved.
//

#import "DBFetcher.h"
#import "SBJson.h" // allows JSON parsing

@implementation DBFetcher

- (id)init
{
    self = [super init];
    if (self) {
        // Initialization code here.
    }
    
    return self;
}

- (NSString*) fetchCollegeData:(int)collegeID
{
	NSString *apiURL = [NSString stringWithFormat:@"http://localhost:8888/CSAPI.php?query=summary&id=%@", collegeID]; // format and attribute are not specified, because all attributes must be returned and format is JSON by default. Url will change after server code is moved to the final server
	NSURL *urlRequest = [NSURL URLWithString:apiURL];
	NSError *err = nil;
	
	NSString *apiOutput = [NSString stringWithContentsOfURL:urlRequest encoding:NSUTF8StringEncoding error:&err];
	
	if (err)
	{
		// error handling, will add later
	}
	else
	{
		return apiOutput;
	}
}

- (NSString*) fetchNewNotifications
{
	NSString *apiURL = @""; // Comments are the 
	NSURL *urlRequest = [NSURL URLWithString:apiURL];
	NSError *err = nil;
	
	NSString *apiOutput = [NSString stringWithContentsOfURL:urlRequest encoding:NSUTF8StringEncoding error:&err];
	
	if (err)
	{
		// error handling, will add later
	}
	else
	{
		return apiOutput;
	}
}

- (NSString*) fetchNewRecommended
{
	NSString *apiURL = @""; // Url uknown?
	NSURL *urlRequest = [NSURL URLWithString:apiURL];
	NSError *err = nil;
	
	NSString *apiOutput = [NSString stringWithContentsOfURL:urlRequest encoding:NSUTF8StringEncoding error:&err];
	
	if (err)
	{
		// error handling, will add later
	}
	else
	{
		return apiOutput;
	}
}

-(void) parseJson:(NSString*) jsonString
{
	// use SBJson code here
}

@end
