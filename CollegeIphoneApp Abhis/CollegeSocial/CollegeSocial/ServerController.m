//
//  DBFetcher.m
//  CollegeSocial
//
//  Created by Rohit Sanbhadti on 8/3/11.
//  Copyright 2011 Harker High School. All rights reserved.
//

#import "ServerController.h"

@implementation ServerController

- (id)init
{
    self = [super init];
    if (self) {
        // Initialization code here.
    }
    
    return self;
}

- (NSArray*) fetchProfileData: (int)studentID
{
	SBJsonParser *jsonParser = [SBJsonParser new];
	NSArray *attributes = [[NSArray alloc] initWithObjects:@"StudentFirstName", @"StudentLastName", @"StudentGPA", @"StudentSATMath", @"StudentSATWriting", @"StudentSATCR", @"StudentMajor", @"StudentSATII1", @"StudentSATII2", @"StudentSATII3", @"StudentSchool", nil];
	NSMutableArray *output = [[NSMutableArray alloc] init];
	for (int i = 0; i < [attributes count]; i++)
	{
		NSString *url = [NSString stringWithFormat:@"http://localhost:8888/counselorReadAPI.php?query=studentusers&columnforid=StudentID&id=%d&attribute=%@", studentID, [attributes objectAtIndex:i]];
		NSURL *urlRequest = [NSURL URLWithString:url];
		NSError *err = nil;
		NSString *apiOutput = [NSString stringWithContentsOfURL:urlRequest encoding:NSUTF8StringEncoding error:&err];
		NSData *parsedApiOutput = [jsonParser objectWithString:apiOutput];
		NSArray *dataArray;
		if ([parsedApiOutput isKindOfClass:[NSArray class]])
		{
			dataArray = parsedApiOutput;
		}
		else
		{
			NSLog(@"The API did not return an array, so the fetch method in ServerController broke.");
		}
		[output addObject:[dataArray objectAtIndex:0]];
	}
	return output;
}

// College list is returned as one huge array, with college named listed in order, and then college ids listed in order. Therefore, array is twice as long as necessary. This might be something to look at in CSAPI later, since ids are superfluous, as id is index+1.
- (NSArray*) fetchCollegeNamesList
{
	SBJsonParser *jsonParser = [SBJsonParser new];
	NSString *url = @"http://localhost:8888/CSAPI.php?query=summary&id=all&attribute=CollegeName";
	NSURL *urlRequest = [NSURL URLWithString:url];
	NSError *err = nil;
	NSString *apiOutput = [NSString stringWithContentsOfURL:urlRequest encoding:NSUTF8StringEncoding error:&err];
	NSData *parsedApiOutput = [jsonParser objectWithString:apiOutput];
	NSArray *dataArray;
	if ([parsedApiOutput isKindOfClass:[NSArray class]])
	{
		dataArray = parsedApiOutput;
	}
	else
	{
		NSLog(@"The API did not return an array, so the fetch method in ServerController broke.");
	}
	return dataArray;
}

- (NSArray*) fetchMyCollegesList:(int)studentID
{
	SBJsonParser *jsonParser = [SBJsonParser new];
	NSString *url = [NSString stringWithFormat:@"http://localhost:8888/counselorReadAPI.php?query=studentcolleges&columnforid=StudentID&id=%d&attribute=SCollegeName", studentID];
	NSURL *urlRequest = [NSURL URLWithString:url];
	NSError *err = nil;
	NSString *apiOutput = [NSString stringWithContentsOfURL:urlRequest encoding:NSUTF8StringEncoding error:&err];
	NSData *parsedApiOutput = [jsonParser objectWithString:apiOutput];
	NSArray *dataArray;
	if ([parsedApiOutput isKindOfClass:[NSArray class]])
	{
		dataArray = parsedApiOutput;
	}
	else
	{
		NSLog(@"The API did not return an array, so the fetch method in ServerController broke.");
	}
	return dataArray;
}

- (NSArray*) fetchMyRecommendedColleges:(int)studentID
{
	SBJsonParser *jsonParser = [SBJsonParser new];
	NSString *url = [NSString stringWithFormat:@"http://localhost:8888/counselorReadAPI.php?query=studentrecommended&columnforid=StudentID&id=%d&attribute=RecommendedName", studentID];
	NSURL *urlRequest = [NSURL URLWithString:url];
	NSError *err = nil;
	NSString *apiOutput = [NSString stringWithContentsOfURL:urlRequest encoding:NSUTF8StringEncoding error:&err];
	NSData *parsedApiOutput = [jsonParser objectWithString:apiOutput];
	NSArray *dataArray;
	if ([parsedApiOutput isKindOfClass:[NSArray class]])
	{
		dataArray = parsedApiOutput;
	}
	else
	{
		NSLog(@"The API did not return an array, so the fetch method in ServerController broke.");
	}
	return dataArray;
}

/* The following code is not currently working.
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
 */
@end
